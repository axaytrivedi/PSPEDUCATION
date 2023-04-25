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
            $table->string('Location')->nullable(50);
            $table->string('DateOfJoining')->nullable();
            $table->string('Gender')->nullable()->length(6);
            $table->string('CourceCode')->nullable()->length(12);
            $table->string('AddressLine1')->nullable();
            $table->string('AddressLine3')->nullable();
            $table->string('AddressLine2')->nullable();
            $table->string('mobile')->nullable()->length(25);
            $table->string('email')->nullable()->length(25);
            $table->string('prevclsname')->nullable()->length(25);
            $table->string('prevownername')->nullable()->length(25);
            $table->string('prevownerno')->nullable()->length(25);
            $table->string('classinfo')->nullable()->length(25);
            $table->string('courses')->nullable()->length(25);
            $table->string('promoted')->nullable()->length(25);
            $table->string('BatchCode')->nullable()->length(12);
            $table->string('AcademinSession')->nullable()->length(25);
            $table->string('Status')->nullable()->length(12);
            $table->string('Title')->nullable()->length(50);

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
