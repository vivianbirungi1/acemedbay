<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\MedicalInsurance;

class MedicalInsuranceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

      for($i = 1; $i <= 10; $i++) {
        MedicalInsurance::factory()->create(); //randomly generating medical insurance using the factory. using a for loop to create 10 random med insurnaces
      }
      //   $medical_insurance = new MedicalInsurance();
      //   $medical_insurance->insurance_company = "Health Insurance Ltd";
      // //  $medical_insurance->policy_number = "45632644";
      //   $medical_insurance->save();
      //
      //   $medical_insurance = new MedicalInsurance();
      //   $medical_insurance->insurance_company = "New Health Insurance";
      // //  $medical_insurance->policy_number = "45638464";
      //   $medical_insurance->save();
      //
      //   $medical_insurance = new MedicalInsurance();
      //   $medical_insurance->insurance_company = "GoCompare Health Insurance";
      // //  $medical_insurance->policy_number = "45694734";
      //   $medical_insurance->save();
      //
      //   $medical_insurance = new MedicalInsurance();
      //   $medical_insurance->insurance_company = "VHI Health Insurance Ltd";
      // //  $medical_insurance->policy_number = "49830944";
      //   $medical_insurance->save();
    }
}
