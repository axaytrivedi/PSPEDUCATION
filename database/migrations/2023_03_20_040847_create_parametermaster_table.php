<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateParameterMasterTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('parameter_masters', function (Blueprint $table) {
            $table->id();
            $table->string('ParaID')->nullable();
            $table->string('Parameter')->nullable();
            $table->string('ParaFilter1')->nullable();
            $table->string('ParaFilter2')->nullable();
            $table->string('ParaCode')->nullable();
            $table->string('ParaDescription')->nullable();
            $table->string('ParaValue')->nullable();
            $table->string('Validity')->nullable();
            $table->string('Approved')->nullable();
            $table->softDeletes();
            $table->timestamps();
            $table->auditableWithDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('parameter_masters');
    }
}
