<?php

namespace App\Controller;

use App\Repositories\BaseRepository;
use Hyperf\Collection\Collection;
use Hyperf\Database\Model\Model;

class CrudController extends AbstractController
{
    public function __construct(
        protected BaseRepository $repository,
        protected Model $model,
        protected array $columns
    ) {
    }

    public function index(): Collection
    {
        return $this->repository->all();
    }

    public function store(): Model
    {
        $params = $this->request->all();
        return $this->repository->create($params);
    }
}