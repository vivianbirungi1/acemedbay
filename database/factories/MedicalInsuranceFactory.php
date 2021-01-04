<?php

namespace Database\Factories;

use App\Models\MedicalInsurance;
use Illuminate\Database\Eloquent\Factories\Factory;

class MedicalInsuranceFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = MedicalInsurance::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'insurance_company' => $this->faker->company
        ];
    }
}
