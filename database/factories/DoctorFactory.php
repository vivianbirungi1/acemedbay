<?php

namespace Database\Factories;

use App\Models\Doctor;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class DoctorFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Doctor::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition() //using the faker library to generate values for doctors
    {
        return [
          'start_date' => $this->faker->date($format = 'Y-m-d', $max = 'now'), //faker library formats a date and sets the time for the date. date is set to now
          'user_id' => User::factory()
        ];
    }
}
