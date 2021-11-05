<?php

namespace modules\Reviews\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use modules\Products\Models\Product;
use modules\Users\Models\User;

/**
 *
 * @OA\Schema(
 * required={"review","product_id","user_id"},
 * @OA\Xml(name="Review"),
 * @OA\Property(property="id", type="integer", readOnly="true", example="1"),
 * )
 */

class Review extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable =["review","product_id","user_id"];
    protected $hidden = ['id', 'deleted_at', 'created_at', 'updated_at'];

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
