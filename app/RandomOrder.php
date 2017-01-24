<?php

namespace App;


class RandomOrder extends Order
{
    public function __construct(array $attributes = [])
    {
        $sales = $this->randomize();
        parent::__construct($sales, $attributes);
    }


    private function randomize()
    {
        $buyingList = [];
        $products = Product::all();
        $numberOfSalesToBeOrdered = $this->numberOfSalesToBeOrdered();

        while(count($buyingList) < $numberOfSalesToBeOrdered){
            $sale = $this->randomizeSale($products);
            //var_dump($sale);
            array_push($buyingList,$sale);
        }

        return $buyingList;
    }

    private function numberOfSalesToBeOrdered()
    {
        $numberOfProductsAvailable = Product::where("stock_quantity", ">", 0)->count();
        return rand(1,$numberOfProductsAvailable);
    }

    private function randomizeSale($products)
    {
        $productToBeAdd = $products[rand(0, count($products) - 1)];
        $quantityOrdered = rand(1, $productToBeAdd->stock_quantity);

       //$productToBeAdd->stock_quantity = $productToBeAdd->stock_quantity - $quantityOrdered;
        //$productToBeAdd->save();

        $saleToBeAdd = new Sale($productToBeAdd,$quantityOrdered);
        return $saleToBeAdd;
    }


}
