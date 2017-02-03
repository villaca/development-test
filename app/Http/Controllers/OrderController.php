<?php

namespace App\Http\Controllers;

use App\Order;
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
        if (Cache::has("orderList")) {
            $orderList = Cache::get("orderList");
        } else {
            $orderList = Order::all();
            Cache::put("orderList", $orderList, 30);
        }

        return view("orders.listing", [
            "data" => $orderList->sortByDesc("created_at"),
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
            return redirect("products")->with("errorMessage", "Order not found!");
        } catch (\Exception $e){
            return redirect("products")->with("errorMessage", "Something went wrong!");
        }

    }
}
