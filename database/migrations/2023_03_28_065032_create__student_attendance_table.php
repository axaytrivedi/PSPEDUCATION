<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentAttendanceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('StudentAttendance', function (Blueprint $table) {
            $table->id();
            $table->string('LectureCode')->nullable()->length(12);
            $table->string('LectureDate')->nullable();
            $table->string('StudentCode')->nullable()->length(12);
            $table->string('AttendanceStatus')->nullable()->length(6);
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
        Schema::dropIfExists('StudentAttendance');
    }
}
