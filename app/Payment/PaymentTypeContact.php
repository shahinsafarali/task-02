<?php

namespace App\Payment;


interface PaymentTypeContact
{
    public function getAmount($startDate, $endDate);

    public function getName();
}
