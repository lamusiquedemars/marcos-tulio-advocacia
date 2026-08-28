<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('appointment_settings', function (Blueprint $table): void {
            $table->string('brevo_meeting_webhook_secret', 64)->nullable()->unique()->after('in_person_booking_url');
        });
    }

    public function down(): void
    {
        Schema::table('appointment_settings', function (Blueprint $table): void {
            $table->dropUnique(['brevo_meeting_webhook_secret']);
            $table->dropColumn('brevo_meeting_webhook_secret');
        });
    }
};
