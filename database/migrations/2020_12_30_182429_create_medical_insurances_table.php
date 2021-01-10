<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMedicalInsurancesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() //runs everything below
    {
        Schema::create('medical_insurances', function (Blueprint $table) { //creates tables and columns
            $table->id();
            $table->string('insurance_company'); //assigning the value as a string
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() //undoes everything in up method
    {
        Schema::dropIfExists('medical_insurances');
    }
}
