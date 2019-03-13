<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSendLogTable extends Migration
{
    /**
     * Run the migrations.
     * send_log (log_id, usr_id, num_id, log_message, log_success (bool), log_created)
     * @return void
     */
    public function up()
    {
        Schema::create('send_log', function (Blueprint $table) {
            $table->bigIncrements('log_id');
            $table->bigInteger('usr_id')->unsigned();
            $table->bigInteger('num_id')->unsigned();
            $table->text('log_message');
            $table->boolean('log_success');
            $table->dateTime('log_created');
        });

        Schema::table('send_log', function($table) {
            $table->foreign('usr_id')->references('usr_id')->on('users');
            $table->foreign('num_id')->references('num_id')->on('numbers');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('send_log');
    }
}
