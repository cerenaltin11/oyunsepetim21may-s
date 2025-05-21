<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('community_likes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('post_id')->nullable()->constrained('community_posts')->onDelete('cascade');
            $table->foreignId('comment_id')->nullable()->constrained('community_comments')->onDelete('cascade');
            $table->string('type')->default('like');
            $table->timestamps();

            // Ensure a user can only like a post or comment once
            $table->unique(['user_id', 'post_id']);
            $table->unique(['user_id', 'comment_id']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('community_likes');
    }
}; 