<?php

namespace App\Modules\Appointments\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Appointments\Models\AppointmentInvitation;
use App\Modules\SiteSettings\Models\SiteSetting;
use App\Support\Modules;
use Illuminate\Contracts\View\View;

class AppointmentInvitationController extends Controller
{
    public function __invoke(string $token): View
    {
        abort_unless(Modules::enabled('appointments'), 404);

        $invitation = AppointmentInvitation::query()
            ->where('token_hash', hash('sha256', $token))
            ->with('inquiry')
            ->firstOrFail();

        abort_unless($invitation->isUsable(), 410);

        if ($invitation->opened_at === null) {
            $invitation->forceFill(['opened_at' => now()])->save();
        }

        return view('site.appointment-invitation', [
            'settings' => SiteSetting::current(),
            'invitation' => $invitation,
        ]);
    }
}
