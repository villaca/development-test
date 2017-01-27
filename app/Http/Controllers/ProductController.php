<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

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

        return view("listing", [
            "data" => $products,
            "tableCaption" => "List of products",
            "controllerName" => "ProductController"
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('products.inserting');
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
            "stockQuantity" => $request->stockQuantity
        ]);

        $url = action("ProductController@show", [$product->id]);
        return redirect($url);
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
            $product = Product::findOrFail($id);

            return view('visualizing', [
                "data" => $product,
                "controllerName" => "ProductController"
            ]);

        } catch (ModelNotFoundException $e){
            redirect("products", ["errorMessage" => "Product not found!"]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        try {
            $product = Product::findOrFail($id);

            return view('products.editing', ["product" => $product]);

        } catch (ModelNotFoundException $e) {
            redirect("products", ["errorMessage" => "Product not found!"]);
        }

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
            $product->setAttribute("stockQuantity", $request->stockQuantity);
            $product->save();

        } catch (ModelNotFoundException $e) {
            redirect("products", ["errorMessage" => "Product not found!"]);
        }

        return redirect("products/show/" . $product->id)->with("success", "Product updated!");
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
