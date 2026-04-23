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
        // user metrics
        Schema::create('user_metrics', function (Blueprint $table) {
            $table->foreignUuid('user_id')->constrained()->cascadeOnDelete();
            $table->unsignedSmallInteger('metric_type')->nullable();
            $table->unsignedBigInteger('value')->default(0);
            $table->timestamps();

            $table->primary(['user_id', 'metric_type']);
        });

        // page metrics
        Schema::create('page_metrics', function (Blueprint $table) {
            $table->foreignUuid('page_id')->constrained()->cascadeOnDelete();
            $table->unsignedSmallInteger('metric_type')->nullable();
            $table->unsignedBigInteger('value')->default(0);
            $table->timestamps();

            $table->primary(['page_id', 'metric_type']);
        });

        // ad metrics
        Schema::create('ad_metrics', function (Blueprint $table) {
            $table->foreignUuid('ad_id')->constrained()->cascadeOnDelete();
            $table->unsignedSmallInteger('metric_type')->nullable();
            $table->unsignedBigInteger('value')->default(0);
            $table->timestamps();

            $table->primary(['ad_id', 'metric_type']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ad_metrics');
        Schema::dropIfExists('page_metrics');
        Schema::dropIfExists('user_metrics');
    }
};
