<?php

/** @var Factory $factory */

use App\Models\Student;
use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Factory;

$factory->define(Student::class, function (Faker $faker) {
    return [
        'name' => $faker->firstName,
        'surname' => $faker->lastName,
        'group_id' => rand(1, 10)
    ];
});
