<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tweet_images', function (Blueprint $table) {
            // tweetsテーブルのPKは 'tweet_id' のため、↓方法で外部キー制約を設定
            $table->unsignedBigInteger('tweet_id');
            $table->foreign('tweet_id')->references('tweet_id')->on('tweets')
            ->cascadeOnDelete();

            // imagesテーブルのPKは 'id' のため、↓の方法で外部キー制約を設定
            $table->foreignId('image_id')->constrained('images')
            ->cascadeOnDelete();

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
        Schema::dropIfExists('tweet_images');
    }
};
