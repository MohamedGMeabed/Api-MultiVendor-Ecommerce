<?php

namespace modules\Cities\Repositories;

use App\Http\Interfaces\AuthInterface;
use App\Http\Traits\ApiDesignTrait;



use Illuminate\Http\Request;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use modules\Cities\Interfaces\CityInterface;

class CityRepository implements CityInterface
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
