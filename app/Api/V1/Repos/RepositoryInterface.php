<?php namespace App\Api\V1\Repos;

interface RepositoryInterface {

    public function all();

    public function findOrFail($id);

    public function findAndUpdate($id, $request);

    public function create($input);

    public function findAndDelete($id);

}