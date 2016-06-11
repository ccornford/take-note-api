<?php namespace App\Api\V1\Repos\Note;

use App\Api\V1\Models\Note;
use App\Api\V1\Repos\EloquentRepository;

class EloquentNoteRepository extends EloquentRepository implements NoteRepositoryInterface {

    protected $model;

    public function __construct(Note $model)
    {
        $this->model = $model;
    }

    public function belongsToGroup($id)
    {
        //TODO find group first and throw 404 if it doesn't exist
        return $this->model->whereGroupId($id)->get();
    }

}