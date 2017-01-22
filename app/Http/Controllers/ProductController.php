<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::paginate(15);

        return view("products.listing", ["products" => $products]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $product = Product::firstOrCreate([
            "name" => $request->name,
            "price" => $request->price,
            "stock_quatity" => $request->stockQuantity
        ]);
        /*
        $product->setAttribute("name", $request->name);
        $product->setAttribute("price", $request->price);
        $product->setAttribute("stock_quantity", $request->stockQuantity);
        $product->save();
        */

        return redirect("products/show/" . $product->getAttribute("id"));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {
            $product = Product::findOrFail($id);
            $product->setAttribute("name", $request->name);
            $product->setAttribute("price", $request->price);
            $product->setAttribute("stock_quantity", $request->stockQuantity);
            $product->save();

        } catch (ModelNotFoundException $e) {
            redirect("products", []);
        }

        return redirect("products/show/" . $product->getAttribute("id"))->with("success", "Product updated!");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Product::destroy($id);
        return redirect("products");
    }
}
