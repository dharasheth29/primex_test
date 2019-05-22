<?php

$factory->define(App\UserRole::class, function (Faker\Generator $faker) {
    return [
        'role' => $faker->randomElement(['Admin','HR','IT Manager','Sales Manager','Product Manager'])
    ];
});

