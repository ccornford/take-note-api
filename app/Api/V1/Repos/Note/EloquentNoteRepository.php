<?php namespace App\Api\V1\Repos\Note;

use App\Api\V1\Models\Note;
use App\Api\V1\Repos\EloquentRepository;

class EloquentNoteRepository extends EloquentRepository implements NoteRepositoryInterface {

    protected $model;

    public function __construct(Note $model)
    {
        $this->model = $model;
    }

}