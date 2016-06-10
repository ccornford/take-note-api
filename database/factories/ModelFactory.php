<?php

use App\Api\V1\Models;

$factory->define(Models\Group::class, function ($faker) {
    return [
        'name' => $faker->name,
    ];
});

$factory->define(Models\Note::class, function ($faker) {
   return [
       'name' => $faker->sentence,
       'group_id' => 1
   ];
});
