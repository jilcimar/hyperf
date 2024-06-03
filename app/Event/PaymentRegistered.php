<?php
namespace App\Event;

class PaymentRegistered
{
    public $payment;

    public function __construct($payment)
    {
        $this->payment = $payment;
    }
}
