<?php

namespace modules\Orders\Repositories;

use App\Http\Traits\ApiDesignTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;
use modules\Orders\Interfaces\OrderInterface;
use modules\Orders\Models\Order;

class OrderRepository implements OrderInterface
{

    use ApiDesignTrait;
    public function __construct()
    {

    }

   
       /**
     * @OA\post(
     *      path="/api/order/create",
     *      operationId="index",
     *      tags={"Order"},
     *      security={ {"sanctum": {} }},
     *      summary="Details Orders",
     *      description="Returns list of Order Details",
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *         @OA\JsonContent(
     *              @OA\Property(property="orders", type="object", ref="#/components/schemas/Order"),
     *          )
     *       ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthenticated",
     *      ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden"
     *      )
     *     )
     */
    public function create(Request $request) {
         $customer_id = auth()->user()->id;
          $user_order = Order::where('user_id',auth()->user()->id )->first();
          $cart = Redis::get('cart_'.$customer_id);
          $cartItems = json_decode($cart,true);
          $productDetails = [];
          foreach($cartItems as $itemDetail){
            $requestItem = explode(',', $itemDetail);
              $productDetails[] =$requestItem;      
          } 
          $total= 0; 
          for ($i = 0; $i<count($productDetails); $i++){
            $total = $total + ($productDetails[$i][1] * $productDetails[$i][2] );
          }
          if(!$user_order || $user_order->status == 'success') {
            $order = Order::create([
                  'user_id' =>auth()->user()->id,
                  'total' => $total,
                  'status' =>0,
                  'shipping' =>150,
                  'payment_id' =>1,
            ]);
            for ($i = 0; $i<count($productDetails); $i++){
                $order->products()->attach(
                    $order->id,
                    [
                    'product_id' => $productDetails[$i][0],
                    'price' =>$productDetails[$i][1],
                    'quantity' =>$productDetails[$i][2],
                ]);
               }
           return $this->ApiResponse(200,"Your Order",null,$order );
          } elseif($user_order->status == 'pending' ) {
            $user_order->delete();
            $order = Order::create([
                 'user_id' =>auth()->user()->id,
                 'total' => $total,
                 'status' =>'pending',
          ]);
          for ($i = 0; $i<count($productDetails); $i++){
            $order->products()->attach(
                $order->id,
                [
                'product_id' => $productDetails[$i][0],
                'price' =>$productDetails[$i][1],
                'quantity' =>$productDetails[$i][2],
            ]);
          }
          return $this->ApiResponse(200,"Your Order",null,$order);
          }
         return $this->ApiResponse(200,"Your Order",null,$user_order);
        //  return $this->ApiResponse(200,"Your Have an Order Not Paid Yet",null,$user_order);
       }
  
         /**
       * @OA\get(
       *      path="/api/order/show",
       *      operationId="index",
       *      tags={"Order"},
       *      security={ {"sanctum": {} }},
       *      summary="show Order Details",
       *      description="Returns list of Order Details",
       *      @OA\Response(
       *          response=200,
       *          description="Successful operation",
       *       ),
       *      @OA\Response(
       *          response=401,
       *          description="Unauthenticated",
       *      ),
       *      @OA\Response(
       *          response=403,
       *          description="Forbidden"
       *      )
       *     )
       */
  
       public function show(){
           $user_order = Order::with(['orderProduct'])->where('user_id',auth()->user()->id )->get();
            return $this->ApiResponse(200,'your Order Details',null,$user_order);
       }
      


}
