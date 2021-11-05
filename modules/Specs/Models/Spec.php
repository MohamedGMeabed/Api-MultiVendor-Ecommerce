<?php

namespace modules\Specs\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use modules\Products\Models\Product;

/**
 *
 * @OA\Schema(
 * required={"name"},
 * @OA\Xml(name="Spec"),
 * @OA\Property(property="id", type="integer", readOnly="true", example="1"),
 * @OA\Property(property="name", type="string", readOnly="true", example="color"),
 * )
 */

class Spec extends Model
{
    use HasFactory,SoftDeletes;
    protected $fillable =["name"];
    protected $hidden = [ 'id', 'created_at', 'updated_at', 'deleted_at'];

    public function products()
    {
        return $this->belongsToMany(Product::class,'product_spec');
    }
}
