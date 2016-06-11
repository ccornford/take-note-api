<?php namespace App\Api\V1\Repos\Note;

use App\Api\V1\Repos\RepositoryInterface;

interface NoteRepositoryInterface extends RepositoryInterface {

    public function belongsToGroup($id);

}