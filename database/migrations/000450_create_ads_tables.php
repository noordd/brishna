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
        // ads
        Schema::create('ads', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('user_id')->nullable()->constrained()->restrictOnDelete();
            $table->foreignId('category_id')->nullable()->constrained()->restrictOnDelete();
            $table->foreignId('currency_id')->nullable()->constrained()->nullOnDelete();

            $table->json('image')->nullable()->default('{}');
            $table->json('gallery')->nullable()->default('{}');
            $table->json('files')->nullable()->default('{}');

            $table->unsignedBigInteger('price')->nullable();
            $table->string('price_type', 32)->nullable()->default('price');
            $table->unsignedInteger('duration')->default(0)->nullable();

            $table->json('settings')->nullable()->default('{}');
            $table->json('extra')->nullable()->default('{}');

            $table->timestamp('free_at')->nullable();
            $table->timestamp('draft_at')->nullable();
            $table->timestamp('published_at')->nullable();
            $table->timestamp('expired_at')->nullable();
            $table->timestamp('hidden_at')->nullable();

            $table->timestamp('created_at')->nullable();
            $table->unsignedSmallInteger('created_at_year')
                ->virtualAs('IFNULL(YEAR(created_at), 0)')
                ->index();
            $table->unsignedTinyInteger('created_at_month')
                ->virtualAs('IFNULL(MONTH(created_at), 0)')
                ->index();

            $table->timestamp('updated_at')->nullable();
            $table->softDeletes();
        });

        // ad translations table
        Schema::create('ad_translations', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('ad_id')->constrained()->cascadeOnDelete();
            $table->string('locale', 35)->nullable();
            $table->foreign('locale')->references('code')->on('locales')
                ->restrictOnUpdate()
                ->restrictOnDelete();

            $table->string('title')->nullable()->index();
            $table->text('content')->nullable();

            $table->json('meta')->nullable()->default('{}');
            $table->json('extra')->nullable()->default('{}');

            $table->timestamp('draft_at')->nullable();
            $table->timestamp('published_at')->nullable();

            $table->unique(['ad_id', 'locale']);
        });

        // ad interaction buffers
        Schema::create('ad_interaction_buffers', function (Blueprint $table) {
            $table->binary('id', 20)->primary();
            $table->foreignUuid('ad_id')->constrained()->cascadeOnDelete();
            $table->ipAddress('ip_address');
            $table->string('user_agent', 255);
            $table->unsignedTinyInteger('interaction_type')->nullable();
            $table->nullableUuidMorphs('source');

            // The Lockout Columns
            $table->date('recorded_at');
            $table->unsignedTinyInteger('period_id'); // 0 for AM, 1 for PM
        });

        // liked ads table
        Schema::create('liked_ads', function (Blueprint $table) {
            $table->foreignUuid('user_id')->constrained()->restrictOnDelete();
            $table->foreignUuid('ad_id')->constrained()->cascadeOnDelete();

            $table->timestamp('created_at')->useCurrent()->nullable();
            $table->timestamp('last_viewed_at')->nullable();

            $table->unique(['user_id', 'ad_id']);
            $table->index('ad_id');
        });

        // ads visited recently
        Schema::create('visited_ads', function (Blueprint $table) {
            $table->foreignUuid('user_id')->constrained()->cascadeOnDelete();
            $table->foreignUuid('ad_id')->constrained()->cascadeOnDelete();

            $table->timestamp('created_at')->useCurrent()->nullable();
            $table->timestamp('last_viewed_at')->nullable();

            $table->primary(['user_id', 'ad_id']);
            $table->index('ad_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists(table: 'visited_ads');
        Schema::dropIfExists(table: 'liked_ads');
        Schema::dropIfExists(table: 'ad_interaction_buffers');
        Schema::dropIfExists('ad_translations');
        Schema::dropIfExists(table: 'ads');
    }
};
