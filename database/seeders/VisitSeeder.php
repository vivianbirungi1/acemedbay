<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Visit;

class VisitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $visit = new Visit();
      $visit->date = "2020-11-19";
      $visit->start_time = "09:50:00";
      $visit->end_time = "10:50:00";
      $visit->duration = "1";
      $visit->cost = "50";
      $visit->doctor_id = "1";
      $visit->patient_id = "1";
      $visit->save();

      $visit = new Visit();
      $visit->date = "2020-11-19";
      $visit->start_time = "09:50:00";
      $visit->end_time = "10:50:00";
      $visit->duration = "1";
      $visit->cost = "50";
      $visit->doctor_id = "2";
      $visit->patient_id = "2";
      $visit->save();

      $visit = new Visit();
      $visit->date = "2020-11-19";
      $visit->start_time = "09:50:00";
      $visit->end_time = "10:50:00";
      $visit->duration = "1";
      $visit->cost = "50";
      $visit->doctor_id = "3";
      $visit->patient_id = "3";
      $visit->save();
    }
}
