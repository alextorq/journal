<?php

use App\Models\Group;
use App\Models\Lesson;
use Faker\Generator as Faker;


$factory->define(Group::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
    ];
});


$factory->define(Lesson::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
    ];
});
