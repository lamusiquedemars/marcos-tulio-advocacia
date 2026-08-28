<?php

namespace App\Modules\Appointments\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Appointments\Models\AppointmentSetting;
use App\Modules\Appointments\Services\BrevoMeetingWebhookHandler;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class BrevoMeetingWebhookController extends Controller
{
    public function __invoke(Request $request, string $secret, string $event, BrevoMeetingWebhookHandler $handler): JsonResponse
    {
        $setting = AppointmentSetting::current();

        abort_unless(
            $setting->brevo_meeting_webhook_secret && hash_equals($setting->brevo_meeting_webhook_secret, $secret),
            404,
        );

        $payload = $request->validate([
            'account_email' => ['required', 'email:rfc'],
            'event_participants' => ['required', 'array', 'min:1'],
            'event_participants.*.EMAIL' => ['required', 'email:rfc'],
            'meeting_name' => ['required', 'string', 'max:255'],
            'meeting_start_timestamp' => ['required', 'date'],
            'meeting_end_timestamp' => ['required', 'date', 'after:meeting_start_timestamp'],
        ]);

        $handler->handle($event, $payload);

        return response()->json(['ok' => true]);
    }
}
