<?php

use Faker\Generator as Faker;


$factory->define(App\Project::class, function (Faker $faker) { //Faker is a PHP library that generates fake data.
    return [
        'title' => $faker->catchPhrase,
        'body' =>  $faker->text,
        'times viewed' => $faker->randomDigit,
        'tags' => $faker->words($nb = 3, $asText = true)
    ];
});