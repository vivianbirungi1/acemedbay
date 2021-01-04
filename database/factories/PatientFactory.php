<?php

namespace Database\Factories;

use App\Models\Patient;
use App\Models\MedicalInsurance;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class PatientFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Patient::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
          'policy_number' => $this->faker->ean8,
          'user_id' => User::factory(),
          'medical_insurance_id' => MedicalInsurance::factory()
        ];
    }
}
