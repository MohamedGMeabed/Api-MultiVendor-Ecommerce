<?php

namespace modules\Cities\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use modules\Countries\Models\Country;

/**
 *
 * @OA\Schema(
 * required={"name"},
 * @OA\Xml(name="Category"),
 * @OA\Property(property="id", type="integer", readOnly="true", example="1"),
 * @OA\Property(property="name", type="string", readOnly="true",  description="Category unique name ", example="Backend"),
 * )
 */

class City extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = ['city', 'street'];
    protected $hidden = ['id', 'deleted_at', 'created_at', 'updated_at'];



    public function country()
    {
        return $this->belongsToMany(Country::class, 'country_id');
    }

}


