<?php

use App\Carrier;
use Faker\Generator as Faker;

$factory->define(Carrier::class, function (Faker $faker) {
  return [
    'names' => $faker->name
  ];
});