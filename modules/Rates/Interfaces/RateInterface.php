<?php
namespace modules\Rates\Interfaces;


interface RateInterface {

    public function allRates();
    public function ratesDetails($request);
    public function createRate($request);
    public function updateRate($request);
    public function softDeleteRate($request);
    public function restoreRate($request);



}
