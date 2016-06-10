<?php namespace App\Api\V1\Repos;

abstract class EloquentRepository implements RepositoryInterface
{
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