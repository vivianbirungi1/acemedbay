<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserRoleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() //runs everything below
    {
        Schema::create('user_role', function (Blueprint $table) { //creating tables and columns
          $table->id();
          $table->bigInteger('user_id')->unsigned(); //making our FK as big integers
          $table->bigInteger('role_id')->unsigned();
          $table->timestamps();

          $table->foreign('user_id')->references('id')->on('users')->onUpdate('cascade')->onDelete('restrict'); //creating FK on the table
          $table->foreign('role_id')->references('id')->on('roles')->onUpdate('cascade')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() //undoes everything in the up method
    {
        Schema::dropIfExists('user_role');
    }
}
