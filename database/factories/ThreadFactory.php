<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Thread;
use Faker\Generator as Faker;

$factory->define(Thread::class, function (Faker $faker) {
    return [
        //
        'subject' => $faker->word(),
        'thread' => $faker->sentence(),
        'type' => $faker->word(),
    ];
});
