<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('locales', function (Blueprint $table) {
            $table->string('code', 10)->primary(); // e.g., 'en', 'ps', 'fa'
            $table->char('dir', 3)->nullable()->default('ltr');
            $table->unsignedSmallInteger('sort_order')->default(0)->index();
            $table->timestamp('hidden_at')->nullable();
            $table->timestamps();
        });

        Schema::create('locale_translations', function (Blueprint $table) {
            $table->string('locale_code', 10);
            $table->foreign('locale_code')->references('code')->on('locales')->cascadeOnDelete();

            // The language this translation is written in
            $table->string('translation_locale', 10);
            $table->foreign('translation_locale')->references('code')->on('locales')->restrictOnDelete();

            $table->string('label', 64);

            $table->primary(['locale_code', 'translation_locale']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('locale_translations');
        Schema::dropIfExists('locales');
    }
};
