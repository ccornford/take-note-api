<?php namespace App\Api\V1\Transformers;

use App\Api\V1\Models\Note;
use League\Fractal\TransformerAbstract;

class NoteTransformer extends TransformerAbstract
{

    public function transform(Note $note)
    {
        return array($note);
    }

}