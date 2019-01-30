<?php

use Faker\Generator as Faker;

$factory->define(
    App\Contracts\Category::class,
    function (Faker $faker) {
        return ([
            'name' => ucfirst($faker->words($nb = 3, $asText = true))
        ]);
    }
);
