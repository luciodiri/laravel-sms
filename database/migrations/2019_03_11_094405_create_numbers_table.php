<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNumbersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('numbers', function (Blueprint $table) {
            $table->bigIncrements('num_id');
            $table->integer('cnt_id')->unsigned();
            $table->text('num_number'); //->unique();
            $table->dateTime('num_created')->default(date('Y-m-d H:i:s'));;
        });

        Schema::table('numbers', function($table) {
            $table->foreign('cnt_id')->references('cnt_id')->on('countries');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('numbers');
    }
}
