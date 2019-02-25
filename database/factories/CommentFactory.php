<?php

use Faker\Generator as Faker;

$factory->define(App\Comment::class, function (Faker $faker) {
    return [
        'text' => $faker->paragraph($nbSentences = 4, $variableNbSentences = true),
    ];
});
