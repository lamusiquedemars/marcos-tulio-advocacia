<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('appointment_settings', function (Blueprint $table): void {
            $table->string('online_booking_url', 2048)->nullable()->after('booking_url');
            $table->string('in_person_booking_url', 2048)->nullable()->after('online_booking_url');
        });

        Schema::create('appointment_invitations', function (Blueprint $table): void {
            $table->id();
            $table->foreignId('inquiry_id')->constrained()->cascadeOnDelete();
            $table->string('type', 30);
            $table->string('booking_url', 2048);
            $table->string('token_hash', 64)->unique();
            $table->timestamp('expires_at');
            $table->timestamp('sent_at')->nullable();
            $table->timestamp('opened_at')->nullable();
            $table->timestamps();

            $table->index(['inquiry_id', 'expires_at'], 'appointment_invitation_inquiry_expiry_idx');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('appointment_invitations');

        Schema::table('appointment_settings', function (Blueprint $table): void {
            $table->dropColumn(['online_booking_url', 'in_person_booking_url']);
        });
    }
};
