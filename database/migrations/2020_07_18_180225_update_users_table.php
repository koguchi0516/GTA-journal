<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('email');
            $table->dropColumn('email_verified_at');
            $table->string('user_id',25)->unique()->after('name')->comment('表示名');
            $table->string('icon',40)->after('password')->comment('トプ画ファイル名');
            $table->string('psid',20)->nullable()->after('icon')->comment('PSID');
            $table->string('profile',140)->nullable()->after('psid')->comment('自己紹介文');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('email')->unique()->after('name');
            $table->timestamp('email_verified_at')->nullable()->after('email');
            $table->dropColumn('user_id');
            $table->dropColumn('icon');
            $table->dropColumn('psid');
            $table->dropColumn('profile');
        });
    }
}