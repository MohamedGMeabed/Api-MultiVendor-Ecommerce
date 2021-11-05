<?php

namespace modules\Products\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use modules\Categories\Models\Category;
use modules\Images\Models\Image;
use modules\Orders\Models\Order;
use modules\Rates\Models\Rate;
use modules\Reviews\Models\Review;
use modules\Specs\Models\Spec;
use modules\Vendors\Models\Vendor;

/**
 *
 * @OA\Schema(
 *     required={"name","description","price","in_stock","price_after","vendor_id"},
 * @OA\Xml(name="Product"),
 *     @OA\Property(property="id", type="integer", readOnly="true", example="1"),
 *     @OA\Property(property="description", type="string", readOnly="true",description="Product description", example="Main Characteristics: ......"),
 *     @OA\Property(property="in_stock", type="integer", readOnly="true", example="111"),
 *     @OA\Property(property="price", type="double", readOnly="true", example="111.00"),
 *     @OA\Property(property="price_after", type="double", readOnly="true", example="111.05"),
 *     @OA\Property(property="has_offer", type="boolean", readOnly="true", example="false"),
 *     @OA\Property(property="vendor_id", type="integer", readOnly="true", example="1"),
 * )
 */

class Product extends Model
{
    use HasFactory,SoftDeletes;
    protected $fillable = ["name", "description", "in_stock", "has_offer", "price", "price_after", "vendor_id"];
    protected $hidden = [ 'id', 'created_at', 'updated_at', 'deleted_at'];

    public function vendor()
    {
        return $this->belongsTo(Vendor::class);
    }
    public function images()
    {
        return $this->hasMany(Image::class);
    }
    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    public function rates()
    {
        return $this->hasMany(Rate::class);
    }

    public function specs()
    {
        return $this->belongsToMany(Spec::class,'product_spec')->withPivot(['value']);
    }

    public function orders()
    {
        return $this->belongsToMany(Order::class,'order_product');
    }
    public function categories()
    {
        return $this->belongsToMany(Category::class, 'category_product');
    }

}
