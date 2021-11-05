<?php


namespace modules\Orders\Controllers;

use App\Http\Traits\ApiDesignTrait;
use Illuminate\Http\Request;
use modules\BaseController;
use modules\Orders\Interfaces\OrderInterface;
use modules\Orders\Models\Order;

class OrderController extends BaseController
{
    use ApiDesignTrait;

    private $OrderInterface;

    public function __construct(OrderInterface $OrderInterface)
    {
        $this->OrderInterface = $OrderInterface;
    }


    public function create(Request $request){
       // $this->authorize('create', Order::class);
        return $this->OrderInterface->create($request);
    }

    public function show(){
       // $this->authorize('view', Order::class);
        return $this->OrderInterface->show();
    }
}
?>
