<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run() //running all the seeders and storing them in the database
    {
      ///call seeders we created here
      $this->call(RoleSeeder::class);
      $this->call(MedicalInsuranceSeeder::class);
      $this->call(UserSeeder::class);
      $this->call(DoctorSeeder::class);
      $this->call(PatientSeeder::class);
      $this->call(VisitSeeder::class);
    }
}
