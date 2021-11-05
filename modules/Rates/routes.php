<?php

use Illuminate\Support\Facades\Route;
use modules\Rates\Controllers\RateController;

Route::get('rates',  [RateController::class, 'allRates']);
Route::get('rates/show',  [RateController::class, 'ratesDetails']);
Route::post('rates/create',  [RateController::class, 'createRate']);
Route::post('rates/edit',  [RateController::class, 'updateRate']);
Route::post('rates/delete',  [RateController::class, 'softDeleteRate']);
Route::post('rates/restore',  [RateController::class, 'restoreRate']);



