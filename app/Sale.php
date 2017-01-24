<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    public $productName;
    public $price;
    public $stock_quantity;
    public $quantityOrdered;


    protected $visible = ['product', 'quantityOrdered'];

    public function __construct($product, $quantityOrdered,array $attributes = [])
    {
        $this->productName = $product->productName;
        $this->price = $product->price;
        $this->stock_quantity = $product->stock_quantity;
        $this->quantityOrdered = $quantityOrdered;
        parent::__construct($attributes);
    }
}
