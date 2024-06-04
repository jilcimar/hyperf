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

use App\Repositories\PaymentRepository;
use App\Request\PaymentRequest;
use GuzzleHttp\Exception\GuzzleException;
use Hyperf\Collection\Collection;
use Hyperf\Database\Model\Model;
use Hyperf\Di\Annotation\Inject;

class PaymentController
{
    #[Inject]
    private PaymentRepository $repository;

    public function index(): Collection
    {
        return $this->repository->all();
    }

    /**
     * @throws GuzzleException
     */
    public function store(PaymentRequest $request): Model
    {
        $params = $request->validated();
        return $this->repository->create($params);
    }
}
