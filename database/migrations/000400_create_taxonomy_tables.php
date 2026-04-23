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
        // categories table
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('lft')->default(0);
            $table->bigInteger('rgt')->default(0);
            $table->unsignedInteger('depth')->default(0);
            $table->unsignedBigInteger('parent_id')->nullable()->default(null);

            $table->string('taxonomy')->nullable();
            $table->string('slug', 128)->nullable();

            $table->json('image')->nullable()->default('{}');
            $table->json('settings')->nullable()->default('{}');
            $table->json('extra')->nullable()->default('{}');

            $table->timestamp('root_at')->nullable()->index();
            $table->timestamp('hidden_at')->nullable();
            $table->timestamp('fixed_at')->nullable();
            $table->timestamp('slug_at')->nullable();
            $table->timestamp('draft_at')->nullable();
            $table->timestamp('published_at')->nullable();
            $table->timestamps();

            // INDEXES
            $table->unique(['parent_id', 'slug']);    // Unique slug within the same parent
            $table->index(['taxonomy', 'lft', 'rgt']); // Fast tree lookups per type
            $table->index(['taxonomy', 'parent_id']); // Fast immediate child lookups per type
            $table->index('rgt'); // Backup for specific tree math
        });

        Schema::create('category_translations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id')->constrained()->cascadeOnDelete();
            $table->string('locale', 10);
            $table->foreign('locale')->references('code')->on('locales')
                ->rcascadeOnDelete()
                ->restrictOnUpdate();

            $table->string('title', 128)->index();
            $table->text('content')->nullable();

            $table->json('meta')->nullable()->default('{}');
            $table->json('extra')->nullable()->default('{}');

            $table->timestamp('draft_at')->nullable();
            $table->timestamp('published_at')->nullable();

            $table->unique(['category_id', 'locale']);
        });

        // tags table
        Schema::create('tags', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('locale', 10);
            $table->foreign('locale')->references('code')->on('locales')
                ->restrictOnUpdate()
                ->restrictOnDelete();
            $table->string('name', 64);
            $table->unsignedBigInteger('usage_count')->default(0)->index();

            // unique constraint for the combination
            $table->unique(['name', 'locale']);
            $table->index('locale');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tags');
        Schema::dropIfExists('categories');
    }
};
