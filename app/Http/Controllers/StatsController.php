<?php

namespace App\Http\Controllers;

use App\Models\DeliveryMethod;
use App\Models\Order;
use Carbon\CarbonPeriod;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\LazyCollection;

class StatsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:sanctum');
    }

    public function ordersCount(Request $request){

        $from = Carbon::now()->subMonth();
        $to  = Carbon::now();

        if($request->has(['from'. 'to'])){
            $from = $request->from;
            $to = $request->to;
        }    

        return $this->response(
            Order::query()
            ->whereBetween('created_at', [$from, Carbon::parse($to)->endOfDay()])
            ->whereRelation('status', 'code', 'closed')
            ->count()
        );
    }

    public function ordersSalesSum(Request $request){

        $from = Carbon::now()->subMonth();
        $to  = Carbon::now();

        if($request->has(['from'. 'to'])){
            $from = $request->from;
            $to = $request->to;
        } 

        return $this->response(
            Order::query()
            ->whereBetween('created_at', [$from, Carbon::parse($to)->endOfDay()])
            ->whereRelation('status', 'code', 'closed')
            ->sum('sum')
        );
    }

    public function DeliveryMethodsRatio(Request $request){

        $from = Carbon::now()->subMonth();
        $to  = Carbon::now();

        if($request->has(['from'. 'to'])){
            $from = $request->from;
            $to = $request->to;
        } 

        $response = [];
        $allOrders = Order::query()
            ->whereBetween('created_at', [$from, Carbon::parse($to)->endOfDay()])
            ->whereRelation('status', 'code', 'closed')
            ->count();
        
        foreach(DeliveryMethod::all() as $deliveryMethod){

            $deliveryMethodOrder = $deliveryMethod->orders()->whereBetween('created_at', [$from, Carbon::parse($to)->endOfDay()])->whereRelation('status', 'code', 'closed')->count();

            //dd($allOrders);
            if($deliveryMethodOrder >0 && $allOrders >0){    
                $response[] = [
                    'name' => $deliveryMethod->name,
                    'persentage' =>(int)$deliveryMethodOrder*100/(int)$allOrders,
                    'amount' => $deliveryMethodOrder,
                ];
            }else{
               return $this->response('Orderlar yuq');
            }

        }

        return $this->response($response);
    }



    public function ordersCountByDays(Request $request){

        $from = Carbon::now()->subMonth();
        $to  = Carbon::now();
        if($request->has(['from'. 'to'])){
            $from = $request->from;
            $to = $request->to;
        }

        $days = CarbonPeriod::create($from, $to);
        $response = new Collection();
        LazyCollection::make($days->toArray())->each(function($day) use($from, $to, $response){
            
            $count = Order::query()
            ->whereBetween('created_at', [$day->startOfDay(), $day->endOfDay()])
            ->whereRelation('status', 'code', 'closed')
            ->count();

            $response[] = [
                'date'=>$day->format('Y-m-d'),
                'orders_count' => $count,
            ];
        });
        return $this->response($response);
    }



    
}
