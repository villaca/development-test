<?php

const DECIMAL_PRECISION = 2;
const MINIMUM_PRICE = 0.00;
const MAXIMUM_PRICE = 999.99;
const MINIMUM_STOCK = 0;
const MAXIMUM_STOCK = 100;

$factory->define(App\Product::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->unique()->colorName, //color names as seemed the best to emulate brands
        'price' => $faker->randomFloat(DECIMAL_PRECISION, MINIMUM_PRICE, MAXIMUM_PRICE),
        'stockQuantity' => $faker->numberBetween(MINIMUM_STOCK, MAXIMUM_STOCK),
    ];
});