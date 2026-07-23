<?php

namespace App\Http\Controllers;

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
    public function create(): View
    {
        abort_unless(Modules::enabled('contact_form'), 404);

        return view('site.contact', [
            'settings' => SiteSetting::current(),
            'page' => Modules::enabled('pages')
                ? Page::query()->where('slug', 'contact')->where('is_published', true)->first()
                : null,
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
            'request_type' => ['required', 'in:analise,consulta,outro'],
            'urgency' => ['nullable', 'in:sem_urgencia,prazo_proximo,urgente'],
            'deadline' => ['nullable', 'date'],
            'location' => ['nullable', 'string', 'max:120'],
            'modality' => ['nullable', 'in:presencial,remoto,indiferente'],
            'consent' => ['required', 'accepted'],
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
            'request_type.required' => 'Selecione o tipo de solicitação.',
            'request_type.in' => 'Selecione um tipo de solicitação válido.',
            'urgency.in' => 'Selecione um grau de urgência válido.',
            'deadline.date' => 'Informe uma data válida.',
            'modality.in' => 'Selecione uma modalidade válida.',
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
        $urgencyLabels = [
            'sem_urgencia' => 'Sem urgência imediata',
            'prazo_proximo' => 'Existe prazo próximo',
            'urgente' => 'Urgente',
        ];
        $modalityLabels = [
            'presencial' => 'Presencial',
            'remoto' => 'Remoto',
            'indiferente' => 'A definir',
        ];

        $data['subject'] = $requestLabels[$data['request_type']];
        $data['message'] = implode("\n", array_filter([
            'Tipo: '.$requestLabels[$data['request_type']],
            isset($data['urgency']) ? 'Urgência: '.$urgencyLabels[$data['urgency']] : null,
            filled($data['deadline'] ?? null) ? 'Data importante: '.$data['deadline'] : null,
            filled($data['location'] ?? null) ? 'Localização: '.$data['location'] : null,
            isset($data['modality']) ? 'Modalidade: '.$modalityLabels[$data['modality']] : null,
            '',
            'Resumo informado:',
            $data['message'],
            '',
            'Consentimento registrado em: '.now()->toIso8601String(),
        ]));

        $message = ContactMessage::fromArray($data);

        if (Modules::enabled('inquiries') && class_exists(StoreInquiry::class)) {
            StoreInquiry::run($message);
        }

        if ($settings->contact_form_send_admin_email && $settings->contact_email) {
            Mail::to($settings->contact_email)->send(new ContactMessageReceived($message));
        }

        if ($settings->contact_form_send_confirmation_email) {
            Mail::to($message->email)->send(new ContactMessageConfirmation($message));
        }

        return redirect()
            ->route('contact')
            ->with('status', Modules::enabled('inquiries')
                ? 'Sua solicitação foi registrada. Este ambiente de demonstração não envia mensagens reais.'
                : 'Sua solicitação foi recebida neste ambiente de demonstração.');
    }
}
