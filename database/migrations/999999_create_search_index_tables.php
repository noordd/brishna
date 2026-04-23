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
        Schema::create('search_indices', function (Blueprint $table) {



            // $table->unsignedSmallInteger('priority')->default(0)->index();
            // $table->timestamps();

            // // INDEX
            // $table->fullText(['title', 'content']);
            // $table->index('category_id');

            $table->uuid('id')->primary();

            // Search Content
            $table->string('title', 512)->nullable();
            $table->text('content')->nullable();

            $table->string('locale', 10);
            $table->unsignedBigInteger('category_id')->nullable(); // Match categories.id type

            // create morph column manuualy to allow both uuid & bigint types
            $table->string('searchable_type')->nullable();
            $table->string('searchable_id')->nullable();

            // Sorting
            $table->unsignedSmallInteger('priority')->default(0);
            $table->timestamps();

            // Full-Text for Keyword Search
            $table->fullText(['title', 'content']);

            // High-Speed Filtering Index
            // This handles: WHERE category_id = ? AND locale = ? ORDER BY priority DESC
            $table->index(['category_id', 'locale', 'priority']);

            // Morph Index for syncing/deleting search entries
            $table->index(['searchable_type', 'searchable_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('search_indices');
    }
};
