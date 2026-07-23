<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('inquiries', function (Blueprint $table): void {
            $table->string('request_type', 30)->nullable()->after('subject');
            $table->string('urgency', 30)->nullable()->after('request_type');
            $table->string('phase', 40)->nullable()->after('urgency');
            $table->date('deadline')->nullable()->after('phase');
            $table->string('location', 120)->nullable()->after('deadline');
            $table->string('modality', 30)->nullable()->after('location');
            $table->timestamp('consent_at')->nullable()->after('message');
            $table->string('source', 40)->default('contact_form')->after('consent_at');

            $table->index(['status', 'urgency', 'created_at'], 'inquiries_follow_up_idx');
        });

        DB::table('inquiries')->where('status', 'new')->update(['status' => 'nova']);
        DB::table('inquiries')->where('status', 'to_handle')->update(['status' => 'em_contato']);
        DB::table('inquiries')->where('status', 'waiting_customer')->update(['status' => 'consulta_solicitada']);
        DB::table('inquiries')->where('status', 'handled')->update(['status' => 'agendada']);
        DB::table('inquiries')->where('status', 'archived')->update(['status' => 'encerrada']);
    }

    public function down(): void
    {
        DB::table('inquiries')->where('status', 'nova')->update(['status' => 'new']);
        DB::table('inquiries')->where('status', 'em_contato')->update(['status' => 'to_handle']);
        DB::table('inquiries')->where('status', 'consulta_solicitada')->update(['status' => 'waiting_customer']);
        DB::table('inquiries')->where('status', 'agendada')->update(['status' => 'handled']);
        DB::table('inquiries')->where('status', 'encerrada')->update(['status' => 'archived']);

        Schema::table('inquiries', function (Blueprint $table): void {
            $table->dropIndex('inquiries_follow_up_idx');
            $table->dropColumn([
                'request_type',
                'urgency',
                'phase',
                'deadline',
                'location',
                'modality',
                'consent_at',
                'source',
            ]);
        });
    }
};
