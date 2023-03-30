<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFacultyAttendanceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('FacultyAttendance', function (Blueprint $table) {
            $table->id();
            $table->string('FacultyCode')->nullable()->length(12);
            $table->string('CalanderDate')->nullable();
            $table->string('InTime')->nullable();
            $table->string('OutTime')->nullable();
            $table->string('AttendanceStatus')->nullable()->length(12);
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
        Schema::dropIfExists('FacultyAttendance');
    }
}
