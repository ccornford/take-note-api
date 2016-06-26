<?php namespace App\Api\V1\Transformers;

use App\Api\V1\Models\Group;
use League\Fractal\TransformerAbstract;

class GroupTransformer extends TransformerAbstract
{

    public function transform(Group $group)
    {
        return $group->toArray();
    }
}