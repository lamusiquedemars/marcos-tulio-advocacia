<?php

namespace App\Http\Controllers;

use App\Modules\Acquisition\Actions\QueueInquiryForCremona;
use App\Modules\Acquisition\Support\Attribution;
use App\Modules\Appointments\Models\AppointmentSetting;
use App\Modules\ContactForm\Data\ContactMessage;
use App\Modules\ContactForm\Mail\ContactMessageConfirmation;
use App\Modules\ContactForm\Mail\ContactMessageReceived;
use App\Modules\Inquiries\Actions\StoreInquiry;
use App\Modules\Pages\Models\Page;
use App\Modules\SiteSettings\Models\SiteSetting;
use App\Support\Modules;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\View\View;

class ContactController extends Controller
{
    public function create(Request $request): View
    {
        abort_unless(Modules::enabled('contact_form'), 404);

        $requestType = $request->query('tipo');
        $requestType = in_array($requestType, ['analise', 'consulta'], true) ? $requestType : 'outro';

        return view('site.contact', [
            'settings' => SiteSetting::current(),
            'requestType' => $requestType,
            'page' => Modules::enabled('pages')
                ? Page::query()->where('slug', 'contact')->where('is_published', true)->first()
                : null,
            'appointmentSettings' => Modules::enabled('appointments') ? AppointmentSetting::current() : null,
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        abort_unless(Modules::enabled('contact_form'), 404);

        $settings = SiteSetting::current();

        $rules = [
            'website' => ['nullable', 'string', 'max:0'],
            'email' => ['required', 'string', 'max:160', 'email:rfc', 'regex:/^[^@\s]+@[^@\s]+\.[^@\s]+$/'],
            'message' => ['required', 'string', 'max:5000'],
            'phone' => ['nullable', 'string', 'max:60'],
            'request_type' => ['nullable', 'in:analise,consulta,outro'],
            'urgency' => ['nullable', 'in:sem_urgencia,prazo_proximo,urgente'],
            'phase' => ['nullable', 'in:nao_informada,investigacao,intimacao_depoimento,prisao,processo_penal,recurso,preventiva'],
            'deadline' => ['nullable', 'date'],
            'location' => ['nullable', 'string', 'max:120'],
            'modality' => ['nullable', 'required_if:request_type,consulta', 'in:presencial,remoto'],
            'consent' => ['required', 'accepted'],
            'acquisition_attribution' => ['nullable', 'json', 'max:20000'],
        ];

        if ($settings->contact_form_show_name) {
            $rules['name'] = ['required', 'string', 'max:120'];
        } else {
            $rules['name'] = ['sometimes', 'nullable', 'string', 'max:120'];
        }

        $data = $request->validate($rules, [
            'name.required' => 'Informe um nome.',
            'email.required' => 'Informe um email.',
            'email.email' => 'Informe um email válido.',
            'email.regex' => 'Informe um email válido.',
            'request_type.in' => 'Selecione um tipo de solicitação válido.',
            'urgency.in' => 'Selecione um grau de urgência válido.',
            'phase.in' => 'Selecione uma fase válida.',
            'deadline.date' => 'Informe uma data válida.',
            'modality.in' => 'Selecione uma modalidade válida.',
            'modality.required_if' => 'Selecione se prefere uma consulta online ou presencial.',
            'message.required' => 'Escreva um resumo inicial.',
            'message.max' => 'O resumo deve ter no máximo 5.000 caracteres.',
            'consent.required' => 'Confirme o consentimento para registrar a solicitação.',
            'consent.accepted' => 'Confirme o consentimento para registrar a solicitação.',
        ]);

        if (! $settings->contact_form_show_name) {
            $data['name'] = $data['email'];
        }

        $requestLabels = [
            'analise' => 'Apresentação de situação',
            'consulta' => 'Solicitação de consulta',
            'outro' => 'Outro contato',
        ];
        $data['request_type'] ??= 'outro';
        $data['subject'] = $requestLabels[$data['request_type']];
        $data['consent_at'] = now()->toIso8601String();
        $data['source'] = 'contact_form';
        $attribution = Attribution::fromJson($data['acquisition_attribution'] ?? null);
        unset($data['acquisition_attribution']);
        $data['attribution_source'] = $attribution['source'];
        $data['attribution_medium'] = $attribution['medium'];
        $data['attribution_campaign'] = $attribution['campaign'];
        $data['attribution_first_touch'] = $attribution['first_touch'];
        $data['attribution_last_touch'] = $attribution['last_touch'];
        $data['attribution_method'] = $attribution['method'];
        $data['attribution_confidence'] = $attribution['confidence'];

        $message = ContactMessage::fromArray($data);

        if (Modules::enabled('inquiries') && class_exists(StoreInquiry::class)) {
            $inquiry = StoreInquiry::run($message);
            QueueInquiryForCremona::run($inquiry);
        }

        if ($settings->contact_form_send_admin_email && $settings->contact_email) {
            Mail::to($settings->contact_email)->send(new ContactMessageReceived($message));
        }

        if ($settings->contact_form_send_confirmation_email) {
            Mail::to($message->email)->send(new ContactMessageConfirmation($message));
        }

        return redirect()
            ->route('contact')
            ->with('status', 'Sua solicitação foi recebida. O escritório entrará em contato pelo canal informado.')
            ->with('acquisition_generate_lead', true);
    }
}
