<?php

use Faker\Generator as Faker;

$factory->define(App\Incident::class, function (Faker $faker) {
    $type = ['Thunderstorm', 'Flood', 'Landslide', 'Fire', 'Other'];
    $cities = ["Colombo","Dehiwela","Moratuwa","Negombo","Sri Jayawardenepura Kotte","Gampaha","Kalutara"];
    $district = ["Colombo", "Gampaha", "Kalutara"];
    $users = [1, 2, 5, 6, 7];
    return [
        'title' => $faker->sentence(),
        'date' => $faker->dateTimeThisYear('now', $timezone = null),
        'type' => $type[rand(0,4)],
        'description' => $faker->paragraph(8, false),
        'latitude' => $faker->latitude(6.443911, 7.271265),
        'longitude' => $faker->longitude(79.877616, 80.344532),
        'city' => $cities[rand(0,6)],
        'district' => $district[rand(0,2)],
        'threat_level' => null,
        'user_id' => $users[rand(0,4)],
        'status' => 'pending',
    ];
});
