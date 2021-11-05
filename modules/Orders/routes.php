<?php

use Illuminate\Support\Facades\Route;
use modules\Orders\Controllers\OrderController;

Route::group(['prefix'=>'order','middleware'=>'auth:sanctum'],function(){
    Route::post('create',[OrderController::class,'create']);
    Route::get('show',[OrderController::class,'show']);
});

