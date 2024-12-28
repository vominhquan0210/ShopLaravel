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
        Schema::create('comments', function (Blueprint $table) {
            $table->id();
            $table->string('cmt');
            $table->unsignedBigInteger('id_user');
            $table->unsignedBigInteger('id_blog');
            $table->string('avatar_user');
            $table->string('name_user');
            $table->integer('level');
            $table->foreign('id_user')->references('id')->on('users');
            $table->foreign('id_blog')->references('id')->on('shopee_blogs');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('comments');
    }
};
