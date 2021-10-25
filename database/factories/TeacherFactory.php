<?php

/** @var Factory $factory */

use App\Models\Teacher;
use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Factory;

$factory->define(Teacher::class, function (Faker $faker) {
    $lessons = [
        'Математика',
        'Программирование',
        'Экономика',
        'Психология',
        'Физика',
        'Английский язык'
    ];

    return [
        'name' => $faker->firstName,
        'surname' => $faker->lastName,
        'lesson_title' => $lessons[rand(0, 5)]
    ];
});
