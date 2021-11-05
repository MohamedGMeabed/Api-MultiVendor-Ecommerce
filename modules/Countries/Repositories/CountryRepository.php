<?php

namespace modules\Countries\Repositories;

use App\Http\Interfaces\AuthInterface;
use App\Http\Traits\ApiDesignTrait;

use App\Models\Category;


use Illuminate\Http\Request;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use modules\Countries\Interfaces\CountryInterface;

class CountryRepository implements CountryInterface
{

    use ApiDesignTrait;



    public function __construct()
    {

    }


    public function login()
    {
        // TODO: Implement login() method.

    }
}
