<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->text('post_title');
            $table->text('post_name');
            $table->text('post_summary')->nullable();
            $table->longText('post_content')->nullable();
            $table->string('meta_description')->nullable();
            $table->string('meta_keyword')->nullable();
            $table->string('post_status');
            $table->unsignedBigInteger('post_author');
            $table->foreign('post_author')->references('id')->on('users')
                ->onDelete('cascade');
            $table->string('post_type');
            $table->string('post_guid')->nullable();
            $table->unsignedBigInteger('post_hits')->default('0');
            $table->unsignedBigInteger('like')->default('0');
            $table->text('post_image')->nullable();
            $table->text('post_image_meta')->nullable();
            $table->string('post_mime_type')->default('');
            $table->enum('comment_status', ['open','closed'])->default ('open');
            $table->unsignedBigInteger('comment_count')->default('0');
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('posts');
    }
}
