<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddAlarmSwitchV4ToNetpingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('netping', function (Blueprint $table) {
            $table->string('alarm_switch_v4');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('netping', function (Blueprint $table) {
            $table->drop('alarm_switch_v4');
        });
    }
}
