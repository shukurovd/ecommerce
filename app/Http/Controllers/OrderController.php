<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreOrderRequest;
use App\Http\Requests\UpdateOrderRequest;
use App\Http\Resources\OrderResource;
use App\Http\Resources\ProductResource;
use App\Models\Order;
use App\Models\Product;
use App\Models\Stock;
use App\Models\UserAddress;
use Illuminate\Http\JsonResponse;

class OrderController extends Controller
{
    
    public function __construct()
    {
        $this->middleware('auth:sanctum');
        $this->authorizeResource(Order::class, 'order');
    }

    public function index(){

        if(request()->has('status_id')){
            return $this->response(OrderResource::collection(
                auth()->user()->orders()->where('status_id', request('status_id'))->paginate(10)
            ));
        }
        return $this->response(OrderResource::collection(auth()->user()->orders()->paginate(10)));
        //return auth()->user()->orders;
    }
   
    public function store(StoreOrderRequest $request)
    {
        dd($request);
        $sum = 0;
        $products = [];
        $notFoundProducts = [];
        $address = UserAddress::find($request->address_id);
        foreach($request['products'] as $requestProduct){
            $product = Product::with('stocks')->find($requestProduct['product_id']);
            $product->quantity = $requestProduct['quantity'];
            $stock = $product->stocks()->find($requestProduct['stock_id']);
            if($stock && $stock->quantity >=(int)$requestProduct['quantity']){
                
                $productWithStock = $product->withStock($requestProduct['stock_id']);
                $productResource= new ProductResource($productWithStock);
                $sum +=  $productResource['price'];
                $products[] = $productResource->resolve();
                
            }else{
                $requestProduct['we_have'] = $stock->quantity;
                $notFoundProducts[] = $requestProduct;
            }
        }
                
        
        if($notFoundProducts ===[] && $products !==[] && $sum !==0){
            $order = auth()->user()->orders()->create([
                'comment' => $request->comment,
                'delivery_method_id' => $request->delivery_method_id,
                'payment_type_id' => $request->payment_type_id,
                'sum' => $sum,
                'status_id' => in_array($request['payment_type_id'], [1,2]) ? 1:10,
                'address' => $address,
                'products' => $products
                
            ]);
    
            
            if($order){
                foreach($products as $product){
                   
                    $stock = Stock::find($product['inventory'][0]['id']);
                    $stock->quantity -= $product['order_quantity'];
                    $stock->save();
                }
            }
    
            return $this->success('order created');
        }else{
            
            return $this->error(
                'some products not found or does not have in inventory',
                ['not_found_products'=> $notFoundProducts],
            );
        }
        
        return 'something went wrong, cant create order';
        
    }

    
    public function show(Order $order):JsonResponse
    {
        return $this->response(new OrderResource($order));
    }

    
    public function edit(Order $order)
    {
        //
    }

   
    public function update(UpdateOrderRequest $request, Order $order)
    {
        //
    }

    
    public function destroy(Order $order)
    {
        $order->delete();
        return 1;
    }
}
