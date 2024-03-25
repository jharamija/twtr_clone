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
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('post_id');
            $table->unsignedBigInteger('parent_comment_id')->nullable();
            $table->integer('likes');
            $table
                ->foreign('user_id')
                ->references('id')
                ->on('users')
                ->cascadeOnDelete();    // => deletes all comments if user is deleted
            $table
                ->foreign('post_id')
                ->references('id')
                ->on('posts')
                ->cascadeOnDelete();    // => deletes all comments if post is deleted
            $table
                ->foreign('parent_comment_id')
                ->references('id')
                ->on('comments');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('comments', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
            $table->dropForeign(['post_id']);
            $table->dropForeign(['parent_comment_id']);
        });

        Schema::dropIfExists('comments');
    }
};
