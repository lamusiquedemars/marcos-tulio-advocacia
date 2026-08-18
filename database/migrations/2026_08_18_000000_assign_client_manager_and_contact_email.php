<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    private const OLD_LOGIN_EMAIL = 'marcos.tulio@marcostulioadvocacia.com.br';

    private const OLD_CONTACT_EMAIL = 'marcostulioadvocacia@hotmail.com';

    private const CONTACT_EMAIL = 'contato@marcostulioadvocacia.com.br';

    public function up(): void
    {
        if (Schema::hasTable('users')) {
            DB::table('users')
                ->where('email', self::OLD_LOGIN_EMAIL)
                ->update([
                    'email' => self::CONTACT_EMAIL,
                    'role' => 'client_manager',
                ]);
        }

        if (Schema::hasTable('site_settings')) {
            DB::table('site_settings')
                ->where('contact_email', self::OLD_CONTACT_EMAIL)
                ->update(['contact_email' => self::CONTACT_EMAIL]);
        }

        if (Schema::hasTable('conversation_settings')) {
            DB::table('conversation_settings')
                ->where('notification_email', self::OLD_CONTACT_EMAIL)
                ->update(['notification_email' => self::CONTACT_EMAIL]);
        }
    }

    public function down(): void
    {
        if (Schema::hasTable('users')) {
            DB::table('users')
                ->where('email', self::CONTACT_EMAIL)
                ->where('role', 'client_manager')
                ->update([
                    'email' => self::OLD_LOGIN_EMAIL,
                    'role' => 'content_editor',
                ]);
        }

        if (Schema::hasTable('site_settings')) {
            DB::table('site_settings')
                ->where('contact_email', self::CONTACT_EMAIL)
                ->update(['contact_email' => self::OLD_CONTACT_EMAIL]);
        }

        if (Schema::hasTable('conversation_settings')) {
            DB::table('conversation_settings')
                ->where('notification_email', self::CONTACT_EMAIL)
                ->update(['notification_email' => self::OLD_CONTACT_EMAIL]);
        }
    }
};
