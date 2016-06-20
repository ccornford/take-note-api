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
        $resource = $this->findOrFail($id);

        $resource->update($request);

        return $resource;
    }

    public function create($input)
    {
        return $this->model->create($input);
    }

    public function findAndDelete($id)
    {
        $resource = $this->findOrFail($id);
        $resource->delete();

        return true;
    }
}