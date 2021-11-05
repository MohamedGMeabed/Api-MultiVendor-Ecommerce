<?php

use Illuminate\Support\Facades\Route;
use modules\Vendors\Controllers\VendorController;

//Route::post('/test',  [AdminController::class, 'test']);

Route::post('vendors/register',  [VendorController::class, 'register']);
Route::post('vendors/login',  [VendorController::class, 'login']);
Route::post('vendors/logout',  [VendorController::class, 'logout']);
Route::post('vendors/update-password',  [VendorController::class, 'updatePassword']);

Route::get('vendors',  [VendorController::class, 'allVendors']);
Route::get('vendors/show',  [VendorController::class, 'vendorDetails']);
Route::post('vendors/edit',  [VendorController::class, 'updateVendor']);
Route::post('vendors/delete',  [VendorController::class, 'softDeleteVendor']);
Route::post('vendors/restore',  [VendorController::class, 'restoreVendor']);


