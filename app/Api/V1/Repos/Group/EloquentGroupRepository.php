<?php namespace App\Api\V1\Repos\Group;

use App\Api\V1\Models\Group;
use App\Api\V1\Repos\EloquentRepository;

class EloquentGroupRepository extends EloquentRepository implements GroupRepositoryInterface {
    private $model;

    public function __construct(Group $model)
    {
        $this->model = $model;
    }

    public function getAll()
    {
        return $this->model->all();
    }
}