<?php

namespace modules\Countries\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 *
 * @OA\Schema(
 * required={"name"},
 * @OA\Xml(name="Category"),
 * @OA\Property(property="id", type="integer", readOnly="true", example="1"),
 * @OA\Property(property="name", type="string", readOnly="true",  description="Category unique name ", example="Backend"),
 * )
 */

class Country extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = ['country', 'parent_id'];
    protected $hidden = ['id', 'deleted_at', 'created_at', 'updated_at'];


    public function countries()
    {
        return $this->belongsTo(self::class, 'parent_id', 'id');
    }



}


