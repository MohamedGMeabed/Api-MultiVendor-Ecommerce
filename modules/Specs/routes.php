<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Redirect;
use modules\Specs\Controllers\SpecController;

Route::middleware('auth:sanctum')->group(function () {
    Route::post('specs', [SpecController::class, 'store'])->name('spec.create');
    Route::get('specs', [SpecController::class, 'index'])->name('spec.all');
    Route::get('specs/{spec}', [SpecController::class, 'show'])->name('spec.category')
        ->missing(function (Request $request) {
            return Redirect::route('spec.notfound');
        });
    Route::put('specs/{spec}', [SpecController::class, 'update'])->name('spec.update')
        ->missing(function (Request $request) {
            return Redirect::route('spec.notfound');
        });
    Route::delete('specs/{spec}', [SpecController::class, 'destroy'])->name('spec.delete')
        ->missing(function (Request $request) {
            return Redirect::route('spec.notfound');
        });
});

Route::get('notfound', [SpecController::class, 'notFound'])->name('spec.notfound');
