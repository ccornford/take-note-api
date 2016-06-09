<?php namespace App\Api\V1\Repos\Group;

use App\Api\V1\Models\Group;
use App\Api\V1\Repos\EloquentRepository;

class EloquentGroupRepository extends EloquentRepository implements GroupRepositoryInterface {

    private $model;

    public function __construct(Group $model)
    {
        $this->model = $model;
    }

    public function all()
    {
        return $this->model->all();
    }

    public function findOrFail($id)
    {
        return $this->model->find($id);
    }

    public function create($input)
    {
        return $this->model->create($input);
    }

    public function findAndDelete($id)
    {
        $group = $this->findOrFail($id);

        if( $group )
        {
            $group->delete();
            return true;
        }

        return false;
    }
}