<?php

use App\Http\Controllers\StatsController;
use Illuminate\Support\Facades\Route;

Route::prefix('stats')->group(function(){

    Route::get('orders-count', [StatsController::class, 'ordersCount']);
    Route::get('orders-sales-sum', [StatsController::class, 'ordersSalesSum']);
    Route::get('delivery-methods-ratio', [StatsController::class, 'DeliveryMethodsRatio']);
    Route::get('orders-count-by-days', [StatsController::class, 'ordersCountByDays']);

});





