<?php

declare(strict_types=1);
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

    public function __construct()
    {
        $this->repository = new PaymentRepository();
        $this->model = new Payment();

        $this->columns = Schema::getColumnListing($this->model->getTable());

        parent::__construct($this->repository, $this->model, $this->columns);
    }
}
