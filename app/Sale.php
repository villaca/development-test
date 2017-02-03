<?php

namespace App;

/**
 * Class Sale
 * @package App
 *
 *  This class represent a single product, with its respective quantity, being ordered among others
 */

class Sale
{
    public $product;
    public $price;

    /**
     * Sale constructor.
     *
     * @param Product $product the single product being sold
     * @param int $quantityOrdered
     */
    public function __construct($product, $quantityOrdered)
    {
        $this->product = $product;
        $this->quantityOrdered = $quantityOrdered;
        $this->price = $this->calculatePrice($product,$quantityOrdered);

    }

    /**
     * @param Product $product
     * @param int $quantityOrdered
     * @return decimal mixed
     */
    private function calculatePrice($product, $quantityOrdered)
    {
        return $product->price * $quantityOrdered;
    }
}
