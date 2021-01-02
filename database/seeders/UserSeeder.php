<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Hash;
use App\Models\Role;
use App\Models\User;
use App\Models\Doctor;
use App\Models\Patient;

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
      $admin->address = '64 Default Lane';
      $admin->phone = '0896657865';
      $admin->email = 'admin@acemedbay.ie';
      $admin->password = Hash::make('secret');
      $admin->save();
      $admin->roles()->attach($role_admin);

      $user = new User();
      $user->name = 'Ted Bo';
      $user->address = '97 Default Lane';
      $user->phone = '0896657865';
      $user->email = 'user@acemedbay.ie';
      $user->password = Hash::make('secret');
      $user->save();
      $user->roles()->attach($role_user);

      $doctor = new User();
      $doctor->name = 'doctor';
      $doctor->address = '58 Default Lane';
      $doctor->phone = '0865543216';
      $doctor->email = 'doctor@acemedbay.ie';
      $doctor->password = Hash::make('secret');
      $doctor->save();
      $doctor->roles()->attach($role_doctor);

      $doctor = new Doctor();
      $doctor->start_date = "2020-11-19";
      $doctor->user_id = "1";
      $doctor->save();

      $doctor = new User();
      $doctor->name = 'Dr.Sam';
      $doctor->address = '58 Default Lane';
      $doctor->phone = '0865543216';
      $doctor->email = 'doctorsam@acemedbay.ie';
      $doctor->password = Hash::make('secret');
      $doctor->save();
      $doctor->roles()->attach($role_doctor);

      $doctor = new Doctor();
      $doctor->start_date = "2020-11-19";
      $doctor->user_id = "2";
      $doctor->save();

      $doctor = new User();
      $doctor->name = 'Dr.Richarch';
      $doctor->address = '58 Default Lane';
      $doctor->phone = '0865543216';
      $doctor->email = 'doctorrich@acemedbay.ie';
      $doctor->password = Hash::make('secret');
      $doctor->save();
      $doctor->roles()->attach($role_doctor);

      $doctor = new Doctor();
      $doctor->start_date = "2020-11-19";
      $doctor->user_id = "3";
      $doctor->save();

      $patient = new User();
      $patient->name = 'patient';
      $patient->address = '13 Default Lane';
      $patient->phone = '0865423657';
      $patient->email = 'patient@acemedbay.ie';
      $patient->password = Hash::make('secret');
      $patient->save();
      $patient->roles()->attach($role_patient);

      $patient = new Patient();
      $patient->policy_number = "456987";
      $patient->user_id = "2";
      $patient->medical_insurance_id = "1";
      $patient->save();

      $patient = new User();
      $patient->name = 'Christina';
      $patient->address = '13 Default Lane';
      $patient->phone = '0865423657';
      $patient->email = 'christina@acemedbay.ie';
      $patient->password = Hash::make('secret');
      $patient->save();
      $patient->roles()->attach($role_patient);

      $patient = new Patient();
      $patient->policy_number = "456987";
      $patient->user_id = "3";
      $patient->medical_insurance_id = "2";
      $patient->save();

      $patient = new User();
      $patient->name = 'Steven';
      $patient->address = '13 Default Lane';
      $patient->phone = '0865423657';
      $patient->email = 'steven@acemedbay.ie';
      $patient->password = Hash::make('secret');
      $patient->save();
      $patient->roles()->attach($role_patient);

      $patient = new Patient();
      $patient->policy_number = "456987";
      $patient->user_id = "4";
      $patient->medical_insurance_id = "3";
      $patient->save();

      // $patient = new Patient();
      // $patient->policy_number = "456987";
      // $patient->user_id = "5";
      // $patient->medical_insurance_id = "4";
      // $patient->save();
    }
}
