<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    public $salesDone = [];
    public $creationTime;

    protected $visible = ['salesDone'];

    public function __construct(array $sales, array $attributes = [])
    {
        parent::__construct($attributes);
        $this->salesDone = $sales;
        $creationTime = time();

    }

    final public function totalPrice()
    {
        $totalPrice = 0;

        for($i = 0; $i < count($this->salesDone) - 1; $i++){
            $totalPrice += $this->salesDone[$i]->product->price;
        }

        return $totalPrice;
    }

    final public function addSale(Sale $sale)
    {
        array_push($this->salesDone, $sale);
    }


}
