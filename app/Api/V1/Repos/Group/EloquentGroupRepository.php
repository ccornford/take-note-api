<?php namespace App\Api\V1\Repos\Group;

use App\Api\V1\Models\Group;
use App\Api\V1\Repos\EloquentRepository;

class EloquentGroupRepository extends EloquentRepository implements GroupRepositoryInterface {

    protected $model;

    public function __construct(Group $model)
    {
        $this->model = $model;
    }

    public function search($param)
    {
        $results = $this->model->with('notes', 'tags')
            ->where("name", "like", "%{$param}%")
            ->get();

        if($results->count() == 0)
        {
            return abort(204);
        }

        return $results;
    }

}