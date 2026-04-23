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
        // users
        Schema::create('users', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignId('province_id')->nullable()->constrained()->restrictOnDelete();
            $table->foreignUuid('inviter_id')->nullable()->constrained('users')->nullOnDelete();

            $table->string('email')->nullable()->unique();
            $table->string('mobile')->nullable()->unique();
            $table->string('password');

            $table->string('slug', 128)->nullable()->unique();

            $table->rememberToken();
            $table->string('verify_token', 10)->nullable()->index();

            $table->json('image')->nullable()->default('{}');
            $table->json('settings')->nullable()->default('{}');
            $table->json('extra')->nullable()->default('{}');

            $table->timestamp('root_at')->nullable()->unique();
            $table->timestamp('verify_token_at')->nullable();
            $table->timestamp('activated_at')->nullable()->index();
            $table->timestamp('blocked_at')->nullable()->index();
            $table->timestamp('hidden_at')->nullable();
            $table->timestamp('verified_at')->nullable();
            $table->timestamp('draft_at')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->timestamp('mobile_verified_at')->nullable();
            $table->timestamp('slug_at')->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->index('created_at');
        });

        // user_translations
        Schema::create('user_translations', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('user_id')->constrained()->cascadeOnDelete();

            $table->string('locale', 10);
            $table->foreign('locale')->references('code')->on('locales')
                ->restrictOnDelete()
                ->restrictOnUpdate();

            $table->string('name', 96)->nullable();
            $table->text('content')->nullable();
            $table->json('meta')->nullable()->default('{}');
            $table->json('extra')->nullable()->default('{}');

            $table->timestamp('draft_at')->nullable();
            $table->timestamp('published_at')->nullable();

            $table->unique(['user_id', 'locale']);
        });

        // role user pivot table (allows to assgin multiple roles to a user)
        Schema::create('role_user', function (Blueprint $table) {
            $table->foreignId('role_id')->constrained()->cascadeOnDelete();
            $table->foreignUuid('user_id')->constrained()->cascadeOnDelete();

            $table->primary(['role_id', 'user_id']);
        });

        // permission user pivot table
        Schema::create('permission_user', function (Blueprint $table) {
            $table->foreignUuid('user_id')->constrained()->cascadeOnDelete();
            $table->foreignId('permission_id')->constrained()->cascadeOnDelete();

            $table->timestamp('denied_at')->nullable();

            $table->primary(['user_id', 'permission_id']);
        });

        // social account table
        Schema::create('social_accounts', function (Blueprint $table) {
            $table->foreignUuid('user_id')->constrained()->cascadeOnDelete();
            $table->string('provider')->nullable();
            $table->string('provider_id')->nullable();
            $table->string('token')->nullable();

            $table->primary(['user_id', 'provider', 'provider_id'], 'social_account_primary');
        });

        // followed users
        Schema::create('followed_users', function (Blueprint $table) {
            $table->foreignUuid('follower_id')->constrained('users')->cascadeOnDelete();
            $table->foreignUuid('followed_id')->constrained('users')->cascadeOnDelete();
            $table->primary(['follower_id', 'followed_id']);
            $table->index('followed_id');

            $table->timestamp('created_at')->useCurrent()->nullable();
            $table->timestamp('last_viewed_at')->nullable();
        });

        // blocked users
        Schema::create('blocked_users', function (Blueprint $table) {
            $table->foreignUuid('blocker_id')->constrained('users')->cascadeOnDelete();
            $table->foreignUuid('blocked_id')->constrained('users')->cascadeOnDelete();
            $table->primary(['blocker_id', 'blocked_id']);
            $table->index('blocked_id');

            $table->timestamp('created_at')->useCurrent()->nullable();
            $table->timestamp('last_viewed_at')->nullable();
        });

        // sessions table
        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->uuid('user_id')->nullable()->index();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->longText('payload');
            $table->integer('last_activity')->index();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sessions');
        Schema::dropIfExists('blocked_users');
        Schema::dropIfExists('followed_users');
        Schema::dropIfExists('social_accounts');
        Schema::dropIfExists('permission_user');
        Schema::dropIfExists('role_user');
        Schema::dropIfExists('user_translations');
        Schema::dropIfExists('users');
    }
};
