<?php

use Illuminate\Support\Facades\Route;
use modules\Carts\Controllers\CartController;

Route::group(['prefix'=>'cart','middleware'=>'auth:sanctum'],function(){
    // Route::get('cart',[CartController::class,'index'])->middleware('can:view_cart');
    // Route::post('create',[CartController::class,'create'])->middleware('can:create_cart');
    Route::get('cart',[CartController::class,'index']);
    Route::post('create',[CartController::class,'create']);
    Route::post('delete',[CartController::class,'delete'])->middleware('can:delete_cart');
});
