<?php

use App\Inventory;
use App\Product;
use Faker\Generator as Faker;

$factory->define(Inventory::class, function (Faker $faker) {
  $dates = [
    "2019-03-01",
    "2019-03-02",
    "2019-03-03",
  ];
  return [
    'quantity' => $faker->randomDigit,
    'availableDate' => $dates[array_rand($dates)],
    'product_id' => Product::all()->random()
  ];
});