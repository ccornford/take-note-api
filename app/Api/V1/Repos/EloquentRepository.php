<?php namespace App\Api\V1\Repos;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

abstract class EloquentRepository implements RepositoryInterface
{
    public function all()
    {
        return $this->model->all();
    }

    public function findOrFail($id)
    {
        try
        {
            return $this->model->findOrFail($id);
        }
        catch(ModelNotFoundException $e)
        {
            throw new NotFoundHttpException;
        }
    }

    public function findAndUpdate($id, $request)
    {
        $group = $this->findOrFail($id);

        $group->update($request);

        return $group;
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