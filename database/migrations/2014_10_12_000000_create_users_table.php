<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() //everything in the up method will run to create the table and columns
    {
        Schema::create('users', function (Blueprint $table) { //creating a new user and passing in the table objects as our blueprint. setting up the user columns
            $table->id();
            $table->string('name');
            $table->string('address');
            $table->string('phone');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() //down method undoes everything in the up method when droppping tables and columns
    {
        Schema::dropIfExists('users');
    }
}
