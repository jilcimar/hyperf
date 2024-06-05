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
use Hyperf\Database\Model\Model;
use Hyperf\Di\Annotation\Inject;
use Hyperf\HttpServer\Contract\RequestInterface;
use Hyperf\Paginator\Paginator;

class PaymentController
{
    #[Inject]
    public PaymentRepository $repository;

    public function index(RequestInterface $request): Paginator
    {
        $currentPage = (int) $request->input('page', 1);

        $collection = $this->repository->all();

        $payments = array_values($collection->forPage($currentPage, 5)->toArray());

        return new Paginator($payments, 5, $currentPage);
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
