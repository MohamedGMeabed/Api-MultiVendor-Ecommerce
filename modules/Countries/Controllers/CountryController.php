<?php


namespace modules\Countries\Controllers;

use App\Http\Traits\ApiDesignTrait;
use App\Http\Traits\ApiResponseTrait;
use App\Rules\MatchOldPassword;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\{
    Hash, Validator
};
use modules\BaseController;
use modules\Categories\Interfaces\CategoryInterface;
use modules\Countries\Interfaces\CountryInterface;


class CountryController extends BaseController
{
    use ApiDesignTrait;

    private $countryInterface;

    public function __construct(CountryInterface $countryInterface)
    {
        $this->countryInterface = $countryInterface;
    }


    public function login(){

    }
}
?>
