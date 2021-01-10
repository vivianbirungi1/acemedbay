<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePatientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() //runs everything in Schema
    {
        Schema::create('patients', function (Blueprint $table) { //creating the table and columns
            $table->id();
            $table->string('medical_insurance');
            $table->integer('policy_number');
            $table->bigInteger('user_id')->unsigned();
            $table->timestamps();

            //creating the foreign key on the table
            $table->foreign('user_id')->references('id')->on('users')->onUpdate('cascade')->onDelete('restrict');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() //undoes everything in up method
    {
        Schema::dropIfExists('patients');
    }
}
