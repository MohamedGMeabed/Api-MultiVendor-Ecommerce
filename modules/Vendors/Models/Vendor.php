<?php

namespace modules\Vendors\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use modules\Cities\Models\City;
use modules\Countries\Models\Country;
use modules\Products\Models\Product;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Sanctum\HasApiTokens;



class Vendor extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes;

    protected $fillable = ['country_id', 'city_id', 'name', 'email', 'contact', 'password'];
    protected $hidden = ['id', 'email_verified_at', 'remember_token', 'deleted_at', 'created_at', 'updated_at'];

    public function products()
    {
        return $this->hasMany(Product::class, 'product_id', 'id');
    }

    public function countries()
    {
        return $this->belongsTo(Country::class, 'country_id', 'id');
    }

    public function cities()
    {
        return $this->belongsTo(City::class, 'city_id', 'id');
    }
}
