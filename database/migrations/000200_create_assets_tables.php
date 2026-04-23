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
        // assets
        Schema::create('assets', function (Blueprint $table) {
            $table->id();
            $table->string('slug', 96)->nullable()->unique();
            $table->json('settings')->nullable()->default('{}');

            $table->timestamp('hidden_at')->nullable();
            $table->timestamps();
        });

        // assets translations
        Schema::create('asset_translations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('asset_id')->constrained()->cascadeOnDelete();
            $table->string('locale', 10);
            $table->foreign('locale')->references('code')->on('locales')
                ->restrictOnDelete()
                ->restrictOnUpdate();

            $table->string('label', 128)->index();
            $table->text('description')->nullable();
            $table->json('meta')->nullable()->default('{}');

            $table->unique(['asset_id', 'locale'], 'at_a_id_locale_unique');
        });

        // asset roles
        Schema::create('asset_roles', function (Blueprint $table) {
            $table->id();
            $table->string('name', 64)->unique();
            $table->unsignedInteger('sort_order')->index();
            $table->timestamp('fixed_at')->nullable()->index();
            $table->timestamps();
        });

        // asset roles translations
        Schema::create('asset_role_translations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('asset_role_id')
                ->constrained('asset_roles', 'id', 'art_ar_id_foreign')
                ->cascadeOnDelete();
            $table->string('locale', 10);
            $table->foreign('locale', 'art_locale_foreign')
                ->references('code')->on('locales')
                ->restrictOnDelete()
                ->restrictOnUpdate();
            $table->string('label', 128)->index('art_label_index');

            $table->unique(['asset_role_id', 'locale'], 'art_ar_id_locale_unique');
        });

        // permissions
        Schema::create('asset_permissions', function (Blueprint $table) {
            $table->id();
            $table->string('group', 128)->index();
            $table->string('name', 128)->unique('ap_name_unique');
            $table->timestamps();
        });

        // permissions translations
        Schema::create('asset_permission_translations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('asset_permission_id')
                ->constrained('asset_permissions', 'id', 'apt_ap_id_foreign')
                ->cascadeOnDelete();

            $table->string('locale', 10);
            $table->foreign('locale', 'apt_locale_foreign')
                ->references('code')->on('locales')
                ->restrictOnDelete()
                ->restrictOnUpdate();
            $table->string('label', 128)->index('apt_label_index');

            $table->unique(['asset_permission_id', 'locale'], 'apt_ap_id_locale_unique');
        });

        // asset_permission_asset pivot table to make permission available for multiple assets
        Schema::create('asset_permission_asset', function (Blueprint $table) {
            $table->foreignId('asset_permission_id')
                ->constrained('asset_permissions', 'id', 'apa_ap_id_foreign')
                ->cascadeOnDelete();

            $table->foreignId('asset_id')
                ->constrained('assets', 'id', 'apa_a_id_foreign')
                ->cascadeOnDelete();

            // Primary key ensures a permission isn't linked to the same asset twice
            $table->primary(['asset_permission_id', 'asset_id'], 'apa_primary');
        });

        // asset permission asset role pivot table
        Schema::create('asset_permission_asset_role', function (Blueprint $table) {
            $table->foreignId('asset_role_id')->constrained()->cascadeOnDelete();
            $table->foreignId('asset_permission_id')->constrained()->cascadeOnDelete();
            $table->primary(['asset_role_id', 'asset_permission_id'], 'ap_id_ar_id_primary');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('asset_permission_asset_role');
        Schema::dropIfExists('asset_permission_asset');
        Schema::dropIfExists('asset_permission_translations');
        Schema::dropIfExists('asset_permissions');
        Schema::dropIfExists('asset_role_translations');
        Schema::dropIfExists('asset_roles');
        Schema::dropIfExists('asset_translations');
        Schema::dropIfExists('assets');
    }
};
