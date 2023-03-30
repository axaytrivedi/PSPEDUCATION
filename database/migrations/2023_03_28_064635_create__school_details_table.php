<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSchoolDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('SchoolDetails', function (Blueprint $table) {
            $table->id();
            $table->string('SchoolName')->length(50);
            $table->string('AddressLine1')->nullable()->length(50);
            $table->string('AddressLine2')->length(50);
            $table->string('AddressLine3')->length(50);
            $table->string('City')->nullable()->length(6);
            $table->string('State')->nullable()->length(6);
            $table->string('Country')->nullable()->length(6);
            $table->string('Pin')->nullable()->length(6);
            $table->string('ContactPerson')->nullable()->length(50);
            $table->string('Email')->nullable()->length(50);
            $table->string('Phone1')->nullable()->length(12);
            $table->string('Phone2')->length(12);
            $table->string('WhatsAppNo')->length(12);
            $table->string('WebsiteLink')->length(50);
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
        Schema::dropIfExists('SchoolDetails');
    }
}
