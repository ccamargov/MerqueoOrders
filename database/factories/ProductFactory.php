<?php

use App\Product;
use Faker\Generator as Faker;

$factory->define(Product::class, function (Faker $faker) {
  return [
    'name' => $faker->text($maxNbChars = 40),
    'quantity' => $faker->randomDigit,
    'availableDate' => $faker->date($format = 'Y-m-d', $max = 'now')
  ];
});