<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;

class ProductController extends Controller
{
    public function __construct()
    {
    }

    public function productOverview()
    {
        return view('products/overview');
    }

    public function getAllProducts()
    {
        $products = Product::all();
        return $products;
    }

    public function storeProduct(Request $request)
    {
        $product = Product::create([
            'name' => $request->name,
        ]);

        return $product->id;
    }

    public function deleteProduct(Request $request)
    {

        Product::destroy($request->id);

        return http_response_code(200);
    }
}
