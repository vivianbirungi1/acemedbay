<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddMedicalInsurancesIdToPatientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() //runs everything below
    {
        Schema::table('patients', function (Blueprint $table) { //creates table and columns
          $table->dropColumn('medical_insurance');
          $table->unsignedBigInteger('medical_insurance_id')->unsigned(); //assigning FK as big integer

          $table->foreign('medical_insurance_id')->references('id')->on('medical_insurances')->onUpdate('cascade')->onDelete('restrict'); //creating FK on table
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() //undoes the up method
    {
        Schema::table('patients', function (Blueprint $table) { //checks if the following exists and drops them
          $table->dropForeign(['medical_insurance_id']);
          $table->dropColumn('medical_insurance_id');
          $table->string('medical_insurance');
        });
    }
}
