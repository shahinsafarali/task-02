<?php


namespace App\Payment;


use App\Models\Employee;

class Hourly implements PaymentTypeContact
{
    /**
     * @var Employee
     */
    private $employee;

    public function __construct(Employee $employee)
    {
        $this->employee = $employee;
    }


    public function getAmount($startDate, $endDate)
    {
        $hours = $this->employee->workHours()
            ->whereBetween('day_date', [$startDate, $endDate])
            ->sum('hours');

        return $hours * $this->employee->payment_amount;
    }


    public function getName(): string
    {
        return 'Hourly';
    }

}
