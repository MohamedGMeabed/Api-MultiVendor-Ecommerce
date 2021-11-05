<?php


namespace modules\Cities\Controllers;

use App\Http\Traits\ApiDesignTrait;
use App\Http\Traits\ApiResponseTrait;
use App\Rules\MatchOldPassword;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\{
    Hash, Validator
};
use modules\BaseController;
use modules\Cities\Interfaces\CityInterface;


class CategoryController extends BaseController
{
    use ApiDesignTrait;

    private $cityInterface;

    public function __construct(CityInterface $cityInterface)
    {
        $this->cityInterface = $cityInterface;
    }


    public function login(){

    }
}
?>
