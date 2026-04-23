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
        Schema::create('permalinks', function (Blueprint $table) {
            $table->uuid('id')->primary();
            // The unique binary hash for fast lookups
            $table->binary('path_hash', 20)->unique();
            $table->string('primary_path', 2048)->unique();
            $table->string('redirect_path', 2048)->nullable();

            // create morph column manuualy to allow both uuid & bigint types
            $table->string('linkable_type')->nullable();
            $table->string('linkable_id')->nullable();
            $table->index(['linkable_type', 'linkable_id']);

            $table->timestamp('redirected_at')->nullable()->index();
            $table->timestamp('last_accessed_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('permalinks');
    }
};
