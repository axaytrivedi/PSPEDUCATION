<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFacultySubjectTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('FacultySubject', function (Blueprint $table) {
            $table->id();
            $table->string('FacultyCode')->nullable()->length(12);
            $table->string('CourseCode')->nullable()->length(12);
            $table->string('SubjectCode')->nullable()->length(12);
            $table->string('EffFrom')->nullable();
            $table->string('EffUpto')->nullable();
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
        Schema::dropIfExists('FacultySubject');
    }
}
