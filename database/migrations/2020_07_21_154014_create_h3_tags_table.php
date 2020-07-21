<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateH3TagsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('h3_tags', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('article_title_id')->comments('記事ID');
            $table->integer('turn')->comments('記事内順序');
            $table->text('h3_content')->comments('書き込み内容');
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
        Schema::dropIfExists('h3_tags');
    }
}
