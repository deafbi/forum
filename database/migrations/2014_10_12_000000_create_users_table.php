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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('username')->unique();
            $table->string('password');
            $table->string('avatar')->default('default.jpg');
            $table->string('avatar_bg')->nullable();
            $table->string('cover')->nullable();
            $table->text('signature')->nullable();
            $table->string('title')->nullable();
            $table->string('username_color')->nullable();
            $table->boolean('show_displayed_group')->default(true);
            $table->boolean('show_cover')->default(true);
            $table->timestamp('last_login_at')->nullable();

            // $table->string('discord_id')->nullable();
            // $table->string('telegram_id')->nullable();
            // $table->string('btc_address')->nullable();

            $table->unsignedBigInteger('post_count')->default(0);
            $table->unsignedBigInteger('topic_count')->default(0);
            $table->unsignedBigInteger('credit')->default(0);

            $table->timestamp('last_activity')->nullable();
            $table->text('last_visited_url')->nullable();
            $table->smallInteger('is_banned')->default(0);

            // $table->foreignId('last_login_id')->constrained('logins');
            // $table->foreignId('role_id')->constrained('roles');
            // $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
