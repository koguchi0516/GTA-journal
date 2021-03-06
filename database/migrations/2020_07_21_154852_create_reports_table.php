<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reports', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('user_id')->comments('報告者ID');
            $table->integer('target_id')->comments('対象記事ID');
            $table->integer('content_type')->comments('ジャンル判定');
            $table->integer('article_title_id')->nullable()->comments('コメント先記事ID');
            $table->integer('reason_id')->comments('報告理由');
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
        Schema::dropIfExists('reports');
    }
}