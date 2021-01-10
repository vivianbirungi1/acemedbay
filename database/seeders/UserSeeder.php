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
    public function run() //seeding in different informations for our users and assinging them roles
    {
      $role_admin = Role::where('name', 'admin')->first(); //declaring the roles of each user at the top first.
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
      $admin->roles()->attach($role_admin); //creating a new user and attaching the admin role

      $user = new User();
      $user->name = 'doctor';
      $user->address = '58 Default Lane';
      $user->phone = '0865543216';
      $user->email = 'doctor@acemedbay.ie';
      $user->password = Hash::make('secret');
      $user->save();
      $user->roles()->attach($role_doctor); //creating new doctor and attaching doctor role

      $doctor = new Doctor();
      $doctor->start_date = "2020-11-19";
      $doctor->user_id = $user->id;
      $doctor->save(); //inputting values needed for a new doctor

      $user = new User();
      $user->name = 'patient';
      $user->address = '13 Default Lane';
      $user->phone = '0865423657';
      $user->email = 'patient@acemedbay.ie';
      $user->password = Hash::make('secret');
      $user->save();
      $user->roles()->attach($role_patient); //creating new patient and assigning pateint role

      $patient = new Patient();
      $patient->policy_number = "456987";
      $patient->user_id = $user->id;
      $patient->medical_insurance_id = "1";
      $patient->save(); //adding information for new patient

      //admin
        for($i = 1; $i <= 2; $i++) {
          $user = User::factory()->create();
          $user->roles()->attach($role_admin); //randomly generating admins using the user factory. using for loop to generate 2 random admins.
        }

        //users
        for($i = 1; $i <= 20; $i++) {
          $user = User::factory()->create();
          $user->roles()->attach($role_user);//randomly generating users using the user factory. using for loop to generate 20 random users.
        }

      //   doctors
        // for($i = 1; $i <= 20; $i++) {
        //   $user = User::factory()->create();
        //   $user->roles()->attach($role_doctor);
        //   $doctor = Doctor::factory()->create([
        //     'user_id' => $user->id,
        //
        //   ]);
        // }

        //  patients
          // for($i = 1; $i <= 20; $i++) {
          //   $user = User::factory()->create();
          //   $user->roles()->attach($role_patient);
          //   $patient = Patient::factory()->create([
          //     'user_id' => $user->id,
          //
          //   ]);
          // }

      // $user = new User();
      // $user->name = 'Ted Bo';
      // $user->address = '97 Default Lane';
      // $user->phone = '0896657865';
      // $user->email = 'user@acemedbay.ie';
      // $user->password = Hash::make('secret');
      // $user->save();
      // $user->roles()->attach($role_user);

      //
      // $user = new User();
      // $user->name = 'Dr.Sam';
      // $user->address = '58 Default Lane';
      // $user->phone = '0865543216';
      // $user->email = 'doctorsam@acemedbay.ie';
      // $user->password = Hash::make('secret');
      // $user->save();
      // $user->roles()->attach($role_doctor);
      //
      // $doctor = new Doctor();
      // $doctor->start_date = "2020-11-19";
      // $doctor->user_id = $user->id;
      // $doctor->save();
      //
      // $user = new User();
      // $user->name = 'Dr.Richarch';
      // $user->address = '58 Default Lane';
      // $user->phone = '0865543216';
      // $user->email = 'doctorrich@acemedbay.ie';
      // $user->password = Hash::make('secret');
      // $user->save();
      // $user->roles()->attach($role_doctor);
      //
      // $doctor = new Doctor();
      // $doctor->start_date = "2020-11-19";
      // $doctor->user_id = $user->id;
      // $doctor->save();


//////////////////

      //
      // $user = new User();
      // $user->name = 'Christina';
      // $user->address = '13 Default Lane';
      // $user->phone = '0865423657';
      // $user->email = 'christina@acemedbay.ie';
      // $user->password = Hash::make('secret');
      // $user->save();
      // $user->roles()->attach($role_patient);
      //
      // $patient = new Patient();
      // $patient->policy_number = "456987";
      // $patient->user_id = $user->id;
      // $patient->medical_insurance_id = "2";
      // $patient->save();
      //
      // $user = new User();
      // $user->name = 'Steven';
      // $user->address = '13 Default Lane';
      // $user->phone = '0865423657';
      // $user->email = 'steven@acemedbay.ie';
      // $user->password = Hash::make('secret');
      // $user->save();
      // $user->roles()->attach($role_patient);
      //
      // $patient = new Patient();
      // $patient->policy_number = "456987";
      // $patient->user_id = $user->id;
      // $patient->medical_insurance_id = "3";
      // $patient->save();


    }
}
