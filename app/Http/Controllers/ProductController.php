<?php

namespace App\Http\Controllers;

use App\DatabaseJson\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(){
        return view('index')->with([
            'products' => Product::all()
        ]);

    }

    public function show($id)
    {
        $product = Product::find($id);
        return view('edit')->with([
            'product' => $product
        ]);
    }

    public function testDB()
    {
        $product = new Product();
        $product->name = 'Phones';
        $product->quantity_in_stock = 34;
        $product->price_per_item = 1200.00;
        $product->save();

        dd($product);
    }

    public function store(Request $request){
        $product = new Product();
        $product->name = $request->name;
        $product->quantity_in_stock = intval($request->quantity_in_stock);
        $product->price_per_item = doubleval($request->price_per_item);
        $product->save();

        return response([
            'code'=>200,
            'message'=>'Product saved',
            'data' => $product->toArray()
        ], 200);
    }

    public function update(Request $request, $id){

            $product = Product::update([
                'name' => $request->name,
                'quantity_in_stock' => intval($request->quantity_in_stock),
                'price_per_item' => doubleval($request->price_per_item)
            ], $id);

            if($product) {
                return response()->json([
                    'code' => 200,
                    'message' => 'Product updated'
                ], 200);
            }

        return response()->json([
            'code' => 404,
            'message' => 'Product not updated'
        ], 200);
    }
}
