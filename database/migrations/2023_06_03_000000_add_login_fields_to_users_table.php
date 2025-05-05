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
        Schema::table('users', function (Blueprint $table) {
            $table->dateTime('last_login_at')->nullable()->after('remember_token');
            $table->dateTime('previous_login_at')->nullable()->after('last_login_at');
            $table->integer('login_count')->default(0)->after('previous_login_at');
            $table->integer('consecutive_days')->default(0)->after('login_count');
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
            $table->dropColumn([
                'last_login_at',
                'previous_login_at',
                'login_count',
                'consecutive_days'
            ]);
        });
    }
}; 