<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSchedulerHeaderTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('SchedulerHeader', function (Blueprint $table) {
            $table->id();
            
            $table->string('location');

            $table->string('CourceCode');
            $table->string('BatchCode');
            $table->string('Date');
            $table->string('LineNo');
            $table->string('Status');
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
        Schema::dropIfExists('SchedulerHeader');
    }
}
