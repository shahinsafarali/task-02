<?php

namespace Database\Seeders;

use App\Models\Employee;
use App\Models\WorkHour;
use Carbon\CarbonPeriod;
use Illuminate\Database\Seeder;

class WorkHourSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $employees = Employee::where('payment_type', 'App\Payment\Hourly')->take(120)->get();

        $period = CarbonPeriod::create('2021-06-20', '2021-07-10');


        foreach ($employees as $employee) {
            foreach ($period as $date) {
                WorkHour::factory()->create([
                    'day_date' => $date,
                    'employee_id' => $employee,
                ]);
            }
        }

    }
}
