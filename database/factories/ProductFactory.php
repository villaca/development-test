<?php

const DECIMAL_PRECISION = 2;
const MINIMUM_PRICE = 0.00;
const MAXIMUM_PRICE = 999999.99;
const MINIMUM_STOCK = 0;
const MAXIMUM_STOCK = 500;

$factory->define(App\Product::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->unique()->colorName,
        'price' => $faker->randomFloat(DECIMAL_PRECISION, MINIMUM_PRICE, MAXIMUM_PRICE),
        'stock_quantity' => $faker->numberBetween(MINIMUM_STOCK, MAXIMUM_STOCK),
    ];
});