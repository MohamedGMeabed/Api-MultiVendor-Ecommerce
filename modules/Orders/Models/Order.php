<?php

namespace modules\Orders\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use modules\Payments\Models\Payment;
use modules\Products\Models\Product;
use modules\Users\Models\User;

/**
 *
 * @OA\Schema(
 * required={"status","shipping","total"},
 * @OA\Xml(name="Order"),
 * @OA\Property(property="id", type="integer", readOnly="true", example="1"),
 * @OA\Property(property="status", type="integer", readOnly="true", description=""),
 * @OA\Property(property="shipping", type="douple", readOnly="true", description=""),
 * @OA\Property(property="total", type="douple", readOnly="true", description=""),
 * )
 */

class Order extends Model
{
    use HasFactory;
    protected $fillable = ["status","shipping","total","user_id","payment_id"];

    public function payment()
    {
        return $this->hasOne(Payment::class);
    }
    public function products()
    {
        return $this->belongsToMany(Product::class, 'order_product','order_id','product_id')
                     ->withPivot(['price','quantity'])
                     ->withTimestamps();
    }

    protected $hidden = ['created_at','updated_at'];

    public function user() {
        return $this->belongsTo(User::class,'user_id');
    }


}
