<?php

namespace App;

class Sale
{
    public $product;
    public $price;

    public function __construct($product, $quantityOrdered,array $attributes = [])
    {
        $this->product = $product;
        $this->quantityOrdered = $quantityOrdered;
        $this->price = $this->calculatePrice($product,$quantityOrdered);

    }

    private function calculatePrice($product,$quantityOrdered){
        return $product->price * $quantityOrdered;
    }
}
