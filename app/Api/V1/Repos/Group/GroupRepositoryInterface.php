<?php namespace App\Api\V1\Repos\Group;

interface GroupRepositoryInterface {

    public function all();

    public function findOrFail($id);

    public function create($input);

    public function findAndDelete($id);

}