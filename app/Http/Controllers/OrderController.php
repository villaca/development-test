<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class OrderController extends Controller
{
    public function index()
    {
        $orderList = Cache::get("orderList");


        return view("orders.listing", [
            "data" => $orderList->salesDone,
            "tableCaption" => "List of orders",
            "controllerName" => "OrderController"
        ]);
    }

    public function edit($id)
    {
        try {
            $product = Product::findOrFail($id);

            return view('products.editing', ["product" => $product]);

        } catch (ModelNotFoundException $e) {
            redirect("products", ["errorMessage" => "Product not found!"]);
        }

    }
}
