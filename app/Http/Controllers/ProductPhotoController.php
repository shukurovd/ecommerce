<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProductPhotoRequest;
use App\Models\Photo;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;

class ProductPhotoController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:sanctum');
    }

    public function index(Product $product){
        return $this->response($product->photos);
    }

    public function store(StoreProductPhotoRequest $request, Product $product){
        
        $path = $request->photos->store('products/'.$product->id, 'public');
        $fullname = $request->photos->getClientOriginalName();

        $product->photos()->create([
            'full_name' => $fullname,
            'path' => $path,
        ]);
       return $this->success('photos added');

    }

    public function destroy(Product $product, Photo $photo){

        Gate::authorize('product:destroy');
        Storage::delete($photo->path);
        $photo->delete();

        return $this->success('Photo deleted');
    }


}
