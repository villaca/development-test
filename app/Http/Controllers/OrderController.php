<?php

namespace App\Http\Controllers;

use App\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class OrderController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //Order::generateRandomOrder();

        /*if (Cache::has("orderList")) {
            $orderList = Cache::get("orderList");
        } else {
            $orderList = Order::all();
            Cache::put("orderList", $orderList, 600);
        }*/

        $orderList = Order::all();

        echo '<pre>';
        var_dump($orderList);
        echo '</pre>';

        return view("orders.listing", [
            "data" => $orderList,
            "tableCaption" => "List of orders",
            "controllerName" => "OrderController"
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function  show($id)
    {
        try {
            $order = Order::findOrFail($id);

            return view('orders.visualizing', [
                "data" => $order,
                "tableCaption" => "Products in this Order",
                "controllerName" => "ProductController"
            ]);

        } catch (ModelNotFoundException $e){
            redirect("products", ["errorMessage" => "Order not found!"]);
        }
    }
}
