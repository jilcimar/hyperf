<?php

/**
 * This file is part of Hyperf.
 *
 * @link     https://www.hyperf.io
 * @document https://hyperf.wiki
 * @contact  group@hyperf.io
 * @license  https://github.com/hyperf/hyperf/blob/master/LICENSE
 */

namespace App\Controller;

use App\Model\Payment;
use App\Repositories\PaymentRepository;
use Hyperf\Database\Schema\Schema;

class PaymentController extends CrudController
{
    private PaymentRepository $paymentRepository;

    public function __construct(PaymentRepository $paymentRepository)
    {
        $this->paymentRepository = $paymentRepository;

        $this->model = new Payment();

        $this->columns = Schema::getColumnListing($this->model->getTable());

        parent::__construct($this->paymentRepository, $this->model, $this->columns);
    }
}
