<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Http\Resources\ProductResource;
use App\Models\Product;

class ProductController extends Controller
{
   
    public function index()
    {
        return ProductResource::collection(Product::cursorPaginate(20));
    }

  
    public function store(StoreProductRequest $request)
    {
        //
    }

    
    public function show($id)
    {
        return Product::with('stocks')->find($id);
    }

    
    public function update(UpdateProductRequest $request, Product $product)
    {
        //
    }

    public function destroy(Product $product)
    {
        //
    }
}
