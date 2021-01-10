<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVisitsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()//everything in the up method will run to create the table and columns
    {
        Schema::create('visits', function (Blueprint $table) { //creating the vsiits tbable and creatign columns in the rable
            $table->id();
            $table->date('date');
            $table->time('start_time');
            $table->time('end_time');
            $table->integer('duration');
            $table->decimal('cost', 6, 2);
            $table->bigInteger('doctor_id')->unsigned(); //assigning the foreign keys as big integers
            $table->bigInteger('patient_id')->unsigned();
            $table->timestamps();

            //creating the foreign keys on the visits table
            $table->foreign('doctor_id')->references('id')->on('doctors')->onUpdate('cascade')->onDelete('restrict');
            $table->foreign('patient_id')->references('id')->on('patients')->onUpdate('cascade')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() //undoes everything in up method
    {
        Schema::dropIfExists('visits');
    }
}
