<?php

use Illuminate\Support\Facades\Route;
use modules\Reviews\Controllers\ReviewController;


Route::middleware('auth:sanctum')->group(function () {


});

Route::get('reviews',  [ReviewController::class, 'allReviews']);
Route::get('reviews/show',  [ReviewController::class, 'reviewDetails']);
Route::post('reviews/create',  [ReviewController::class, 'createReview']);
Route::post('reviews/edit',  [ReviewController::class, 'updateReview']);
Route::post('reviews/delete',  [ReviewController::class, 'softDeleteReview']);
Route::post('reviews/restore',  [ReviewController::class, 'restoreReview']);

