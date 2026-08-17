<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    private const LOGO_PATH = '/images/brand/logo-mta-horizontal-bold-transparent-800.png';

    public function up(): void
    {
        if (! Schema::hasTable('site_settings')) {
            return;
        }

        DB::table('site_settings')
            ->whereNull('logo_media_id')
            ->whereNull('logo_path')
            ->update(['logo_path' => self::LOGO_PATH]);
    }

    public function down(): void
    {
        if (! Schema::hasTable('site_settings')) {
            return;
        }

        DB::table('site_settings')
            ->whereNull('logo_media_id')
            ->where('logo_path', self::LOGO_PATH)
            ->update(['logo_path' => null]);
    }
};
