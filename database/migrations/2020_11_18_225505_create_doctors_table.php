<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDoctorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() //runs everything below
    {
        Schema::create('doctors', function (Blueprint $table) { //creating table and columns
            $table->id();
          //  $table->string('name');
            $table->date('start_date');
            $table->bigInteger('user_id')->unsigned(); //assigning foreign key as big integer
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onUpdate('cascade')->onDelete('restrict'); //creating the foreign key on table

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() //undoes everything in up method
    {
        Schema::dropIfExists('doctors');
    }
}
