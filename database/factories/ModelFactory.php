<?php

use App\Api\V1\Models\Group;

$factory->define(Group::class, function ($faker) {
    return [
        'name' => $faker->name,
    ];
});
