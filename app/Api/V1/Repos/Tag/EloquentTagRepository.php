<?php namespace App\Api\V1\Repos\Tag;

use App\Api\V1\Models\Tag;
use App\Api\V1\Repos\EloquentRepository;

class EloquentTagRepository extends EloquentRepository implements TagRepositoryInterface {

    protected $model;

    public function __construct(Tag $model)
    {
        $this->model = $model;
    }

}