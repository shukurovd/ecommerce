<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:sanctum');
    }
   
    public function index()
    {
        return ProductResource::collection(Product::cursorPaginate(20));
    }

  
    public function store(StoreProductRequest $request)
    {
        $product = Product::create($request->toArray());
        return $this->success('Product create', new ProductResource($product));
    }

    
    public function show($id)
    {
        return new ProductResource(Product::with('stocks')->find($id));
    }

    
    public function update(UpdateProductRequest $request, Product $product)
    {
        //
    }

    public function destroy(Product $product)
    {
        Gate::authorize('product:delete');

        Storage::delete($product->photos()->pluck('path')->toArray());
        $product->photos()->delete();
        $product->delete();

    }

    public function related(Product $product){
        return $this->response(
            ProductResource::collection(
                Product::query()
                    ->where('category_id', $product->category_id)
                    ->limit(20)
                    ->get())
        );
    }
}
