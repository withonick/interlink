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
            $table->string('firstname');
            $table->string('surname')->nullable();
            $table->string('username')->unique();
            $table->string('status')->nullable();
            $table->string('image')->nullable();
            $table->string('email')->unique();
            $table->date('birthday')->nullable();
            $table->string('gender')->nullable();
            $table->string('pronouns')->nullable();
            $table->text('bio')->nullable();
            $table->json('socials')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
            $table->timestamp('last_seen_at')->nullable();
            $table->boolean('is_online')->default(false);
            $table->softDeletes();
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
