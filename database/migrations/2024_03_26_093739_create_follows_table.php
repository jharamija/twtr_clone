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
        Schema::create('follows', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('follower_id');  // user that is following
            $table->unsignedBigInteger('followed_id');  // user being followed
            $table
                ->foreign('follower_id')
                ->references('id')
                ->on('users')
                ->onCascade('delete');
            $table
                ->foreign('followed_id')
                ->references('id')
                ->on('users')
                ->onCascade('delete');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('follows', function (Blueprint $table) {
            $table->dropForeign(['follower_id']);
            $table->dropForeign(['followed_id']);
        });

        Schema::dropIfExists('follows');
    }
};
