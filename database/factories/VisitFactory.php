<?php

namespace Database\Factories;

use App\Models\Visit;
use App\Models\Doctor;
use App\Models\Patient;
use Illuminate\Database\Eloquent\Factories\Factory;

class VisitFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Visit::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
          'date' => $this->faker->date($format = 'Y-m-d', $max = 'now'),
          'start_time' => $this->faker->time($format = 'H:i:s', $max = 'now'),
          'end_time' => $this->faker->time($format = 'H:i:s', $max = '+1 hour'),
          'duration' => $this->faker->randomDigit,
          'cost' => $this->faker->randomFloat(2,5,100), //random float with 2 decimal places, min:5 and max: 100
          'doctor_id' => Doctor::factory(),
          'patient_id' => Patient::factory()
        ];
    }
}
