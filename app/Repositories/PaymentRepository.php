<?php

namespace App\Repositories;

use App\Enum\PaymentStatus;
use App\Model\Payment;
use Hyperf\Collection\Collection;
use Hyperf\Database\Model\Model;

class PaymentRepository extends BaseRepository
{
    public function __construct()
    {
        parent::__construct(new Payment());
    }

    public function create(array|Collection $attributes): Model
    {
        $attributes['status'] = PaymentStatus::PENDING->value;
        return parent::create($attributes);
    }
}