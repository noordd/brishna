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
        // messages
        Schema::create('messages', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('sender_id')->constrained('users')->cascadeOnDelete();
            $table->foreignUuid('receiver_id')->constrained('users')->cascadeOnDelete();
            $table->nullableUuidMorphs('messageable');

            $table->text('content')->nullable()->fulltext();

            $table->timestamp('read_at')->nullable();
            $table->timestamp('deleted_at_sender')->nullable();
            $table->timestamp('deleted_at_receiver')->nullable();
            $table->timestamps();

            $table->index(['receiver_id', 'read_at']);
            $table->index(['sender_id', 'read_at']);
            $table->index(['sender_id', 'deleted_at_sender']);
            $table->index(['receiver_id', 'deleted_at_receiver']);
            $table->index('created_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('messages');
    }
};
