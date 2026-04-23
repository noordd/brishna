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
        // countries
        Schema::create('countries', function (Blueprint $table) {
            $table->id();
            $table->string('short_code', 2)->unique();
            $table->string('long_code', 3)->unique();
            $table->string('isd_code', 7)->index();
            $table->timestamp('hidden_at')->nullable();
            $table->timestamps();
        });

        // country translations
        Schema::create('country_translations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('country_id')->constrained()->cascadeOnDelete();
            $table->string('locale', 10);
            $table->foreign('locale')->references('code')->on('locales')
                ->restrictOnDelete()
                ->restrictOnUpdate();

            $table->string('name', 128);

            $table->unique(['country_id', 'locale']);
        });

        // provinces / states
        Schema::create('provinces', function (Blueprint $table) {
            $table->id();
            $table->foreignId('country_id')->constrained()->restrictOnDelete();
            $table->string('short_code', 8)->nullable()->index();
            $table->string('long_code', 12)->nullable()->index();
            $table->timestamp('hidden_at')->nullable();
            $table->timestamps();
        });

        // province translations
        Schema::create('province_translations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('province_id')->constrained()->cascadeOnDelete();
            $table->string('locale', 10);
            $table->foreign('locale')->references('code')->on('locales')
                ->restrictOnDelete()
                ->restrictOnUpdate();

            $table->string('name', 128);

            $table->unique(['province_id', 'locale']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('province_translations');
        Schema::dropIfExists('provinces');
        Schema::dropIfExists('country_translations');
        Schema::dropIfExists('countries');
    }
};
