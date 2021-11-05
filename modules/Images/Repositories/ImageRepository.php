<?php

namespace modules\Images\Repositories;

use App\Http\Interfaces\AuthInterface;
use App\Http\Traits\ApiDesignTrait;

use App\Models\Image;


use Illuminate\Http\Request;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use modules\Images\Interfaces\ImageInterface;

class ImageRepository implements ImageInterface
{

    use ApiDesignTrait;



    public function __construct()
    {

    }


    public function create()
    {
        // TODO: Implement login() method.

    }
}
