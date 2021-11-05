<?php
namespace modules\Reviews\Interfaces;


interface ReviewInterface {

    public function allReviews();
    public function reviewDetails($request);
    public function createReview($request);
    public function updateReview($request);
    public function softDeleteReview($request);
    public function restoreReview($request);

}
