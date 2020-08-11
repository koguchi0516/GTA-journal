<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
// App\Http\Controllers\Users\SettingController;

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
            $table->string('user_code')->unique()->after('name')->comment('表示名');
            $table->string('icon')->after('password')->comment('トプ画ファイル名');
            $table->string('psid')->nullable()->after('icon')->comment('PSID');
            $table->string('profile')->nullable()->after('psid')->comment('自己紹介文');
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
            $table->dropColumn('user_code');
            $table->dropColumn('icon');
            $table->dropColumn('psid');
            $table->dropColumn('profile');
        });
    }
}