<?php

namespace Database\Factories;

use App\Models\Employee;
use App\Models\WorkHour;
use Illuminate\Database\Eloquent\Factories\Factory;

class WorkHourFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = WorkHour::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'employee_id' => Employee::where('payment_type', 'App\Payment\Hourly')->inRandomOrder()->first(),
            'hours' => $this->faker->randomDigitNot(0),
            'day_date' => $this->faker->date('Y-m-d', now())
        ];
    }
}
