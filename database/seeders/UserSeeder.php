<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Hash;
use App\Models\Role;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $role_admin = Role::where('name', 'admin')->first();
      $role_user = Role::where('name', 'user')->first();
      $role_doctor = Role::where('name', 'doctor')->first();
      $role_patient = Role::where('name', 'patient')->first();

      $admin = new User();
      $admin->name = 'Viv Bir';
      $admin->email = 'admin@acemedbay.ie';
      $admin->phone = '0896657865';
      $admin->password = Hash::make('secret');
      $admin->save();
      $admin->roles()->attach($role_admin);

      $user = new User();
      $user->name = 'Ted Bo';
      $user->email = 'user@acemedbay.ie';
      $user->phone = '0896657865';
      $user->password = Hash::make('secret');
      $user->save();
      $user->roles()->attach($role_user);

      $doctor = new User();
      $doctor->name = 'doctor';
      $doctor->email = 'doctor@acemedbay.ie';
      $doctor->phone = '0865543216';
      $doctor->password = Hash::make('secret');
      $doctor->save();
      $doctor->roles()->attach($role_doctor);

      $patient = new User();
      $patient->name = 'patient';
      $patient->email = 'patient@acemedbay.ie';
      $patient->phone = '0865423657';
      $patient->password = Hash::make('secret');
      $patient->save();
      $patient->roles()->attach($role_patient);
    }
}
