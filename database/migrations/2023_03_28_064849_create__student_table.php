<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Student', function (Blueprint $table) {
            $table->id();
            $table->string('StudentCode')->nullable()->length(12);
            $table->string('RollNo')->nullable()->length(12);
            $table->string('StudentName')->nullable()->length(50);
            $table->string('DOB')->nullable();
            $table->string('DateOfJoining')->nullable();
            $table->string('Gender')->nullable()->length(6);
            $table->string('CourceCode')->nullable()->length(12);
            $table->string('BatchCode')->nullable()->length(12);
            $table->string('AcademinSession')->nullable()->length(25);
            $table->string('Status')->nullable()->length(12);
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
        Schema::dropIfExists('Student');
    }
}
