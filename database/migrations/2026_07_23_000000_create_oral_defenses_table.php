<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('oral_defenses', function (Blueprint $table): void {
            $table->id();
            $table->string('type', 20)->default('video');
            $table->string('title');
            $table->text('context')->nullable();
            $table->string('video_url', 2048)->nullable();
            $table->foreignId('video_media_id')->nullable()->constrained('media_assets')->nullOnDelete();
            $table->foreignId('thumbnail_media_id')->nullable()->constrained('media_assets')->nullOnDelete();
            $table->text('initial_situation')->nullable();
            $table->text('legal_question')->nullable();
            $table->text('strategy')->nullable();
            $table->text('intervention')->nullable();
            $table->boolean('is_anonymized')->default(false);
            $table->boolean('is_featured')->default(false);
            $table->string('status', 20)->default('draft');
            $table->unsignedSmallInteger('position')->default(0);
            $table->timestamp('published_at')->nullable();
            $table->timestamps();

            $table->index(['status', 'type', 'is_featured', 'position'], 'oral_defenses_public_selection_idx');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('oral_defenses');
    }
};
