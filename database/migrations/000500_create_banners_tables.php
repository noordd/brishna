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
        // banners
        Schema::create('banners', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('user_id')->constrained()->restrictOnDelete();

            $table->unsignedSmallInteger('banner_type')->nullable()->default(1);
            $table->unsignedSmallInteger('link_type')->nullable()->default(1);
            $table->mediumText('link')->nullable();

            $table->json('image')->nullable()->default('{}');

            $table->unsignedInteger('duration')->default(0)->nullable();

            $table->json('settings')->nullable()->default('{}');
            $table->json('extra')->nullable()->default('{}');

            $table->timestamp('draft_at')->nullable();
            $table->timestamp('published_at')->nullable();
            $table->timestamp('expired_at')->nullable();
            $table->timestamp('hidden_at')->nullable();

            $table->timestamp('created_at')->nullable()->index();
            $table->unsignedSmallInteger('created_at_year')
                ->virtualAs('IFNULL(YEAR(created_at), 0)')
                ->index();
            $table->unsignedSmallInteger('created_at_month')
                ->virtualAs('IFNULL(MONTH(created_at), 0)')
                ->index();

            $table->timestamp('updated_at')->nullable();
            $table->softDeletes();
        });

        // banner translations
        Schema::create('banner_translations', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('banner_id')->constrained()->cascadeOnDelete();
            $table->string('locale', 35)->nullable();
            $table->foreign('locale')->references('code')->on('locales')
                ->restrictOnDelete()
                ->restrictOnUpdate();

            $table->string('title')->nullable()->index();
            $table->string('content', 2048)->nullable();

            $table->timestamp('draft_at')->nullable();
            $table->timestamp('published_at')->nullable();

            $table->json('meta')->nullable()->default('{}');
            $table->json('extra')->nullable()->default('{}');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('banner_translations');
        Schema::dropIfExists('banners');
    }
};
