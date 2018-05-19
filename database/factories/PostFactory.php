<?php

use Faker\Generator as Faker;

$factory->define(App\Entities\Post::class, function (Faker $faker) {
    return [
        'name'    => $faker->unique()->sentence,
        'content' => $faker->sentences(5, true),
    ];
});
