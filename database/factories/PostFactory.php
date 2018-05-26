<?php

use Faker\Generator as Faker;

$factory->define(App\Entities\Post::class, function (Faker $faker) {
    return [
        'name'    => $faker->unique()->sentence,
        'content' => $faker->paragraphs(5, true ),
    ];
});
