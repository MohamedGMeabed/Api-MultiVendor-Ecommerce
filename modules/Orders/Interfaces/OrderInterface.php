<?php
namespace modules\Orders\Interfaces;

use Illuminate\Http\Request;

interface OrderInterface {

    public function create(Request $request);
    public function show();



}
