<?php

use App\Inventory;
use App\Product;
use Faker\Generator as Faker;

$factory->define(Inventory::class, function (Faker $faker) {
  return [
    'quantity' => $faker->randomDigit,
    'availableDate' => $faker->date($format = 'Y-m-d', $max = 'now'),
    'product_id' => Product::all()->random()
  ];
});