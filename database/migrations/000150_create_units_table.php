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
        // currencies
        Schema::create('currencies', function (Blueprint $table) {
            $table->id();
            $table->string('code', 3)->unique();
            $table->string('numeric_code', 3)->nullable()->unique();
            $table->string('symbol', 10)->nullable();
            $table->unsignedTinyInteger('minor_unit')->default(2); // e.g., 2 for cents as in $1.24

            $table->timestamp('hidden_at')->nullable();
            $table->timestamps();
        });

        // currencies translations
        schema::create('currency_translations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('currency_id')->constrained()->cascadeOnDelete();
            $table->string('locale', 10);
            $table->foreign('locale')->references('code')->on('locales')
                ->restrictOnDelete()
                ->restrictOnUpdate();

            $table->string('name', 64)->index();
            $table->string('long_name', 128)->nullable();
            $table->text('description')->nullable();

            $table->unique(['currency_id', 'locale']);
        });

        // coins for the internal use of the app
        Schema::create('coins', function (Blueprint $table) {
            $table->id();
            // A unique code for internal logic (e.g., "BRC", "GEM")
            $table->string('code', 20)->unique();
            $table->string('symbol', 10)->nullable();
            $table->unsignedInteger('sort_order')->default(0)->index();

            $table->timestamp('hidden_at')->nullable();
            $table->timestamps();
        });

        // cpins translations
        schema::create('coin_translations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('coin_id')->constrained()->cascadeOnDelete();
            $table->string('locale', 10);
            $table->foreign('locale')->references('code')->on('locales')
                ->restrictOnDelete()
                ->restrictOnUpdate();

            $table->string('name', 64)->nullable()->index();
            $table->string('long_name', 128)->nullable();
            $table->text('description')->nullable();

            $table->unique(['coin_id', 'locale']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('currency_translations');
        Schema::dropIfExists('currencies');
        Schema::dropIfExists('coin_translations');
        Schema::dropIfExists('coins');
    }
};
