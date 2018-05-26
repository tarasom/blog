<?php

use Faker\Generator as Faker;

$factory->define(\App\Entities\Category::class, function (Faker $faker) {
    return [
        'name'        => $faker->unique()->words(3, true    ),
        'description' => $faker->sentences(5, true),
    ];
});
