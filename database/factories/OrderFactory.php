<?php

use App\Order;
use Faker\Generator as Faker;

$factory->define(Order::class, function (Faker $faker) {
  $dates = [
    "2019-03-01",
    "2019-03-02",
    "2019-03-03",
  ];
  return [
    'priority' => $faker->randomDigit,
    'address' => $faker->address,
    'personName' => $faker->name,
    'deliverDate' => $dates[array_rand($dates)]
  ];
});