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
        // page types
        Schema::create('page_types', function (Blueprint $table) {
            $table->id();
            $table->string('slug', 96)->unique();
            $table->timestamp('hidden_at')->nullable();
            $table->timestamps();
        });

        // page types translations
        Schema::create('page_type_translations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('page_type_id')->constrained()->cascadeOnDelete();
            $table->string('locale', 10);
            $table->foreign('locale')->references('code')->on('locales')
                ->restrictOnDelete()
                ->restrictOnUpdate();

            $table->string('label', 128)->index();
            $table->text('description')->nullable();

            $table->unique(['page_type_id', 'locale'], 'page_type_locale_unique');
        });

        // page badges
        Schema::create('page_badges', function (Blueprint $table) {
            $table->id();
            $table->string('name', 64)->unique();
            $table->string('color', 16)->nullable();
            $table->unsignedTinyInteger('rank')->nullable();
            $table->timestamps();
        });

        // page badges translations
        Schema::create('page_badge_translations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('page_badge_id')->constrained()->cascadeOnDelete();
            $table->string('locale', 10);
            $table->foreign('locale')->references('code')->on('locales')
                ->restrictOnDelete()
                ->restrictOnUpdate();

            $table->string('label', 128)->index();
            $table->string('description')->nullable();
        });

        // pages
        Schema::create('pages', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignId('asset_id')->constrained()->cascadeOnDelete();
            $table->foreignId('page_type_id')->constrained()->restrictOnDelete();
            $table->foreignUuid('user_id')->constrained()->restrictOnDelete();
            $table->foreignId('page_badge_id')->nullable()
                ->constrained()
                ->restrictOnDelete()
                ->restrictOnUpdate();

            $table->string('slug', 128)->unique();

            $table->json('image')->nullable()->default('{}');

            // location & contacts
            $table->foreignId('country_id')->constrained()->restrictOnDelete();
            $table->foreignId('province_id')->constrained()->restrictOnDelete();

            $table->string('email', 192)->nullable();
            $table->string('primary_phone', 64)->nullable();
            $table->string('office_phone', 64)->nullable();
            $table->string('whatsapp', 64)->nullable();
            $table->boolean('use_primary_for_whatsapp')->default(false);
            $table->string('website', 255)->nullable();
            $table->json('socials')->nullable()->default('{}');

            // Geo-Location
            $table->decimal('latitude', 10, 8)->nullable();
            $table->decimal('longitude', 11, 8)->nullable();
            $table->json('location_meta')->nullable()->default('{}');

            $table->json('settings')->nullable()->default('{}');
            $table->json('extra')->nullable()->default('{}');

            $table->timestamp('verified_at')->nullable();
            $table->timestamp('hidden_at')->nullable();
            $table->timestamp('draft_at')->nullable();
            $table->timestamp('published_at')->nullable();
            $table->timestamp('closed_at')->nullable(); // Permanent closure
            $table->timestamp('slug_at')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->index(['page_type_id', 'user_id']);
        });

        // Page Translations Table
        Schema::create('page_translations', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('page_id')->constrained()->cascadeOnDelete();
            $table->string('locale', 10);
            $table->foreign('locale')->references('code')->on('locales')
                ->restrictOnDelete()
                ->restrictOnUpdate();

            $table->string('title')->index();
            $table->text('content')->nullable();

            // location & contacts
            $table->string('contact_name', 160)->nullable();
            $table->string('address', 255)->nullable();
            $table->string('direction_tips', 255)->nullable(); // E.g. "Behind the Blue Mosque"
            $table->string('contact_availability', 128)->nullable();

            $table->json('meta')->nullable()->default('{}');
            $table->json('extra')->nullable()->default('{}');

            $table->timestamp('draft_at')->nullable();
            $table->timestamp('published_at')->nullable();

            $table->unique(['page_id', 'locale']);
        });

        // page, role, and user pivot table
        Schema::create('page_role_user', function (Blueprint $table) {
            $table->foreignUuid('user_id')->constrained()->cascadeOnDelete();
            $table->foreignUuid('page_id')->constrained()->cascadeOnDelete();
            $table->foreignId('asset_role_id')->constrained()->cascadeOnDelete();

            $table->timestamps();

            $table->primary(['user_id', 'page_id']);
            $table->index('page_id');
        });

        // asset permission user pivot table
        Schema::create('page_permission_user', function (Blueprint $table) {
            $table->foreignUuid('user_id')->constrained()->cascadeOnDelete();
            $table->foreignUuid('page_id')->constrained()->cascadeOnDelete();
            $table->foreignId('asset_permission_id')->constrained()->cascadeOnDelete();

            $table->timestamp('denied_at')->nullable();

            $table->primary(['user_id', 'page_id', 'asset_permission_id'], 'user_page_ap_primary');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('page_permission_user');
        Schema::dropIfExists('page_role_user');
        Schema::dropIfExists('page_translations');
        Schema::dropIfExists('pages');
        Schema::dropIfExists('page_badge_translations');
        Schema::dropIfExists('page_badges');
        Schema::dropIfExists('page_type_translations');
        Schema::dropIfExists('page_types');
    }
};
