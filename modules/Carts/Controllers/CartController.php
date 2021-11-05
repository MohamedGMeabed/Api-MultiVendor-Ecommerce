<?php

namespace modules\Carts\Controllers;

use Illuminate\Http\Request;
use modules\BaseController;
use modules\Carts\Interfaces\CartInterface;

class CartController extends BaseController
{

    private $cartInterface;

    public function __construct(CartInterface $cartInterface)
    {
        $this->cartInterface = $cartInterface;
    } 

    
    public function index(){
        return $this->cartInterface->index();  
    }
    
    public function create(Request $request) {
      return  $this->cartInterface->create($request);
    }


    public function delete(){
       return $this->cartInterface->delete();
    }
 }