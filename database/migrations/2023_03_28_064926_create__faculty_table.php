<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFacultyTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Faculty', function (Blueprint $table) {
            $table->id();
            $table->string('FacultyCode')->nullable()->length(12);
            $table->string('Title')->nullable()->length(6);
            $table->string('FacultyName')->nullable()->length(50);
            $table->string('DOB')->nullable();
            $table->string('DateOfJoining')->nullable();
            $table->string('Gender')->nullable()->length(6);
            $table->string('Qualification')->nullable()->length(50);
            $table->string('WorkingStartTime')->nullable();
            $table->string('WorkingEndTime')->nullable();
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
        Schema::dropIfExists('Faculty');
    }
}
