<?php

use Faker\Generator as Faker;

$factory->define(
    App\Contracts\Product::class,
    function (Faker $faker) {
        return ([
            'name' => ucfirst($faker->words($nb = 3, $asText = true))
        ]);
    }
);
