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
        // posts
        Schema::create('posts', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('user_id')->constrained()->cascadeOnDelete();
            $table->foreignUuid('parent_id')
                ->nullable()
                ->index()
                ->constrained('posts')
                ->nullOnDelete();

            $table->string('content', 2048)->nullable();
            $table->json('meta')->nullable()->default('{}');

            $table->nullableUuidMorphs('linkable');
            $table->timestamp('draft_at')->nullable();
            $table->timestamp('published_at')->nullable()->index();
            $table->timestamp('expired_at')->nullable()->index();

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

        // post attachments
        Schema::create('post_attachments', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('post_id')->constrained('posts')->cascadeOnDelete();
            $table->unsignedTinyInteger('attachment_type')->nullable()->default(0);
            $table->string('url', 2048)->nullable();
            $table->json('meta')->nullable()->default('{}');
            $table->timestamp('created_at')->useCurrent()->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('post_attachments');
        Schema::dropIfExists('posts');
    }
};
