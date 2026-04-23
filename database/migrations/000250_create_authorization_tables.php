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
        // roles
        Schema::create('roles', function (Blueprint $table) {
            $table->id();
            $table->string('name', 96)->unique();
            $table->unsignedInteger('sort_order')->index();
            $table->timestamp('fixed_at')->nullable()->index();
            $table->timestamp('hidden_at')->nullable();
            $table->timestamps();
        });

        // roles translations
        Schema::create('role_translations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('role_id')->constrained()->cascadeOnDelete();
            $table->string('locale', 10);
            $table->foreign('locale')->references('code')->on('locales')
                ->restrictOnDelete()
                ->restrictOnUpdate();
            $table->string('label', 128)->index();

            $table->unique(['role_id', 'locale']);
        });

        // permissions
        Schema::create('permissions', function (Blueprint $table) {
            $table->id();
            $table->string('group', 128)->index();
            $table->string('name', 128)->unique();

            $table->timestamp('hidden_at')->nullable();
            $table->timestamps();
        });

        // permissions translations
        Schema::create('permission_translations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('permission_id')->constrained()->cascadeOnDelete();
            $table->string('locale', 10);
            $table->foreign('locale')->references('code')->on('locales')
                ->restrictOnDelete()
                ->restrictOnUpdate();
            $table->string('label', 128)->index();

            $table->unique(['permission_id', 'locale']);
        });

        // permission role pivot table
        Schema::create('permission_role', function (Blueprint $table) {
            $table->foreignId('role_id')->constrained()->cascadeOnDelete();
            $table->foreignId('permission_id')->constrained()->cascadeOnDelete();
            $table->primary(['permission_id', 'role_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('permission_role');
        Schema::dropIfExists('permission_translations');
        Schema::dropIfExists('permissions');
        Schema::dropIfExists('role_translations');
        Schema::dropIfExists('roles');
    }
};
