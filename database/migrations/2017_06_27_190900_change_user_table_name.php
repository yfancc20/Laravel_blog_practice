<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeUserTableName extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $from = "user";
        $to = "users";
        Schema::rename($from, $to);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        $from = "users";
        $to = "user";
        Schema::rename($from, $to);
    }
}
