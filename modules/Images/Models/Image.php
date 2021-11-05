<?php

namespace modules\Images\Models;

use App\Http\Controllers\Api\Modules\Products\Product;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 *
 * @OA\Schema(
 * required={"image",""},
 * @OA\Xml(name="Image"),
 * @OA\Property(property="id", type="integer", readOnly="true", example="1"),
 * @OA\Property(property="image", type="string", readOnly="true", description="image path http//:public/image.jpg"),
 * )
 */

class Image extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = ['image'];


    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
