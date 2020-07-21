<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArticleTitlesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('article_titles', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('user_id')->comments('作成者ID');
            $table->string('title')->comments('記事タイトル');
            $table->integer('category')->comments('カテゴリ');
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
        Schema::dropIfExists('article_titles');
    }
}
