<?php

namespace Database\Factories;

use App\Models\Department;
use App\Models\Employee;
use Illuminate\Database\Eloquent\Factories\Factory;

class EmployeeFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Employee::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        //to make data meaningful I set a few constraints

        $paymentTypes = ['App\Payment\Monthly', 'App\Payment\Hourly'];

        $paymentType = $this->faker->randomElement([0,1]);
        $paymentAmountMax =  $paymentType === 0 ? 5000 : 50;
        $paymentAmountMin =  $paymentType === 0 ? 1000 : 10;

        return [
            'first_name' => $this->faker->firstName(),
            'last_name' => $this->faker->lastName,
            'birth_date' => $this->faker->date('Y-m-d', now()->subYears(18)),
            'position' => $this->faker->text(7),
            'payment_type' => $paymentTypes[$paymentType],
            'payment_amount' => $this->faker->randomFloat(2, $paymentAmountMin, $paymentAmountMax),
            'department_id' => Department::inRandomOrder()->first()
        ];
    }
}
