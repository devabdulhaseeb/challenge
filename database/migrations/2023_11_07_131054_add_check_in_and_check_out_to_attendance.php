<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCheckInAndCheckOutToAttendance extends Migration
{
    public function up()
    {
        Schema::table('attendance', function (Blueprint $table) {
            $table->time('check_in')->nullable()->default(null);
            $table->time('check_out')->nullable()->default(null);
        });
    }

    public function down()
    {
        Schema::table('attendance', function (Blueprint $table) {
            $table->dropColumn('check_in');
            $table->dropColumn('check_out');
        });
    }
}

