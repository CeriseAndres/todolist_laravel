<?php

use Faker\Generator as Faker;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(App\Todoaction::class, function (Faker $faker) {
    return [
        'label' => 'task '.str_random(10),
    	'todolist_id' => rand(1, 20),
    ];
});
