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
    public function up()
    {
        Schema::table('patients', function (Blueprint $table) {
          $table->dropColumn('medical_insurance');
          $table->unsignedBigInteger('medical_insurance_id')->unsigned();

          $table->foreign('medical_insurance_id')->references('id')->on('medical_insurances')->onUpdate('cascade')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('patients', function (Blueprint $table) {
          $table->dropForeign(['medical_insurance_id']);
          $table->dropColumn('medical_insurance_id');
          $table->string('medical_insurance');
        });
    }
}
