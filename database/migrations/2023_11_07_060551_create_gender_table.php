<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::create('gender', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->timestamps();
        });
        Schema::table('users', function (Blueprint $table){
            $table->unsignedBigInteger('gender_id')->nullable();
            $table->foreign('gender_id')->references('id')->on('gender');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['gender_id']);
            $table->dropColumn('gender_id');
        });

        Schema::dropIfExists('gender');
    }
};
