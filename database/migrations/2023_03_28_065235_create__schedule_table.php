<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateScheduleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Schedule', function (Blueprint $table) {
            $table->id();
            $table->string('LectureCode')->nullable()->length(12);
            $table->string('CourceCode')->nullable()->length(12);
            $table->string('BatchCode')->nullable()->length(12);
            $table->string('DateOfWeek')->nullable()->length(6);
            $table->string('Session')->nullable()->length(12);
            $table->string('TimingFrom')->nullable();
            $table->string('TimingUpto')->nullable();
            $table->string('SubjectCode')->nullable()->length(12);
            $table->string('FacultyCode')->nullable()->length(12);
            $table->string('Venue')->nullable()->length(50);
            $table->string('EffFrom')->nullable()->length(12);
            $table->string('EffUpto')->nullable()->length(12);
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
        Schema::dropIfExists('Schedule');
    }
}
