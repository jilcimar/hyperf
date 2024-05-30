<?php

namespace App\Enum;

enum PaymentStatus: string
{
    case PENDING = 'PENDING';
    case APPROVED = 'APPROVED';
    case CANCELED = 'CANCELED';

    case DELAYED = 'DELAYED';
}