<?php namespace App\Api\V1\Transformers;

use App\Api\V1\Models\Tag;
use League\Fractal\TransformerAbstract;

class TagTransformer extends TransformerAbstract
{

    public function transform(Tag $tag)
    {
        return array($tag);
    }

}