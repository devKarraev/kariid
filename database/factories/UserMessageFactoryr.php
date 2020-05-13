<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\UserMessage;
use Faker\Generator as Faker;
use Illuminate\Support\Arr;

$factory->define(UserMessage::class, function (Faker $faker) {
    $txt = $faker->realText(rand(100, 500));
    $createdAt = $faker->dateTimeBetween('-3 months','-2 months');
    $status = Arr::random(['canceled', 'approved', 'pending']);
    $imageRand = rand(1,3);
    $imageRand == 3 ? $imageRand = 'Cute-kittens-12929201-1600-1200.jpg' : $imageRand = null;

    $data = [
        'user_name'     => $faker->name,
        'user_email'    => $faker->unique()->safeEmail,
        'image_path'    => $imageRand,
        'message_text'  => $txt,
        'status'        => $status,
        'is_edited'     => rand(0, 1),
        'created_at'    => $createdAt,
        'updated_at'    => $createdAt,
    ];

    return $data;
});
