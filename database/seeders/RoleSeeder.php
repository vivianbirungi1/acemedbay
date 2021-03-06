<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() //creaitng roles of different users in the database and seeing them in
    {
      //creating roles, want to seed db with admin and users
      $role_admin = new Role(); //Role now stored in role admin , need to set name and description
      $role_admin->name = 'admin';
      $role_admin->description = 'An administrator';
      $role_admin->save(); //stores admin role


      // $role_user = new Role();
      // $role_user->name = 'user';
      // $role_user->description = 'An oridnary user';
      // $role_user->save();

      $role_doctor = new Role();
      $role_doctor->name = 'doctor';
      $role_doctor->description = 'An oridnary doctor';
      $role_doctor->save();

      $role_patient = new Role();
      $role_patient->name = 'patient';
      $role_patient->description = 'An oridnary patient';
      $role_patient->save();
    }
}
