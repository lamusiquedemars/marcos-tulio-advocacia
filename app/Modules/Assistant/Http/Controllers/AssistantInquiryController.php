<?php

namespace App\Modules\Assistant\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Assistant\Contracts\AssistantProvider;
use App\Modules\Inquiries\Actions\StoreInquiry;
use App\Support\Modules;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class AssistantInquiryController extends Controller
{
    public function __invoke(Request $request, AssistantProvider $provider): JsonResponse
    {
        abort_unless(Modules::enabled('assistant') && Modules::enabled('inquiries'), 404);

        $data = $request->validate([
            'website' => ['nullable', 'string', 'max:0'],
            'request_type' => ['required', 'in:analise,consulta,outro'],
            'urgency' => ['required', 'in:sem_urgencia,prazo_proximo,urgente'],
            'phase' => ['required', 'in:nao_informada,investigacao,intimacao_depoimento,prisao,processo_penal,recurso,preventiva'],
            'modality' => ['nullable', 'in:presencial,remoto,indiferente'],
            'name' => ['required', 'string', 'max:120'],
            'email' => ['required', 'string', 'max:160', 'email:rfc', 'regex:/^[^@\s]+@[^@\s]+\.[^@\s]+$/'],
            'phone' => ['nullable', 'string', 'max:60'],
            'location' => ['nullable', 'string', 'max:120'],
            'summary' => ['required', 'string', 'max:1500'],
            'consent' => ['required', 'accepted'],
        ], [
            'consent.accepted' => 'Confirme o consentimento antes de registrar a solicitação.',
            'summary.max' => 'Use no máximo 1.500 caracteres e não envie documentos ou detalhes desnecessários.',
        ]);

        StoreInquiry::run($provider->qualify($data));

        return response()->json([
            'message' => 'Solicitação fictícia registrada. Nenhuma mensagem externa foi enviada.',
        ], 201);
    }
}
