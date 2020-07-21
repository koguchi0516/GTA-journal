<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRecruitingFriendsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('recruiting_friends', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('user_id')->comments('ユーザーID');
            $table->string('purpose')->comments('目的');
            $table->integer('expiration_date')->comments('PSID表示期間');
            $table->text('friend_message')->comments('メッセージ');
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
        Schema::dropIfExists('recruiting_friends');
    }
}
