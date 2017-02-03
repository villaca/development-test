<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{

    public function products()
    {
        return $this->belongsToMany('App\Product')->withPivot("productQuantity", "price");
    }


    /**
     * Public contract for placing random orders
     *
     * @return Order an order with randomized products and
     * quantities of each product
     */
    public static function generateRandomOrder()
    {
        $randomOrder = new Order();
        $randomOrder->totalPrice = 0;
        $randomOrder->save();

        $randomOrder->randomize();
        return $randomOrder;
    }


    /**
     *  Builds the random order
     */
    private function randomize()
    {
        $products = Product::all();
        $numberOfSalesToBeOrdered = $this->numberOfSalesToBeOrdered();

        $salesDone = 0;
        while ($salesDone < $numberOfSalesToBeOrdered) {
            $sale = $this->randomizeSale($products);


            $this->products()->attach(
                $sale->product->id,
                [
                    'productQuantity' =>  $sale->quantityOrdered,
                    'price' => $sale->price
                ]
            );

            $this->totalPrice += $sale->price;
            $this->save();
            $salesDone++;
            $products->forget($sale->product->id -1);
        }
    }

    /**
     * @return int how many products will be ordered
     */
    private function numberOfSalesToBeOrdered()
    {
        $numberOfProductsAvailable = Product::where("stockQuantity", ">", 0)->count();
        return rand(1,$numberOfProductsAvailable);
    }

    /**
     * @param $products a collection of product that can possibly ordered
     * @return Sale a random product with a random respective quantity
     */
    private function randomizeSale($products)
    {
        $productToBeAdd = $products[rand(0, count($products) - 1)];
        $quantityOrdered = rand(1, $productToBeAdd->stockQuantity);

        $saleToBeAdd = new Sale($productToBeAdd,$quantityOrdered);
        return $saleToBeAdd;
    }

}
