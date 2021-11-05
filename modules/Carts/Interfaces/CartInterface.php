<?php
namespace modules\Carts\Interfaces;


interface CartInterface {

    public function index();
    public function create($request);
    public function delete();



}
