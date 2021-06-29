<?php


namespace App\Payment;


use App\Models\Employee;

class Monthly implements PaymentTypeContact
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
        return  $this->employee->payment_amount;
    }

    public function getName(): string
    {
        return 'Monthly';
    }

}
