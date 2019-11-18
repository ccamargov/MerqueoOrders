<?php

use App\Order;
use Faker\Generator as Faker;

$factory->define(Order::class, function (Faker $faker) {
  return [
    'priority' => $faker->randomDigit,
    'address' => $faker->address,
    'personName' => $faker->name,
    'deliverDate' => $faker->date($format = 'Y-m-d', $max = 'now')
  ];
});