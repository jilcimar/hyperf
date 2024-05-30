<?php

namespace App\Repositories;

use Hyperf\Collection\Collection;
use Hyperf\Database\Model\Model;
use Hyperf\DbConnection\Db;

class BaseRepository
{
    /**
     * BaseRepository constructor.
     */
    public function __construct(
        protected Model $model,
        protected ?string $resourceType = null,
        protected ?Model  $resourceInstance = null
    )
    {
    }

    /**
     * Store a newly created resource in storage.
     */
    public function create(Collection|array $attributes): Model
    {
        return Db::transaction(function () use ($attributes) {
            return $this->model->create($attributes);
        });
    }

    /**
     * TODO:: Return paginated collection
     */
    public function all(): Collection | array
    {
        return $this->model->where('deleted_at', '=', null)->get();
    }
}
