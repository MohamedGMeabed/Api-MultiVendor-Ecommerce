<?php


namespace modules\Vendors\Controllers;

use App\Http\Traits\ApiDesignTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\{
    Hash, Validator
};
use modules\BaseController;
use modules\Vendors\Interfaces\VendorInterface;
use modules\Vendors\Requests\LoginRequest;
use modules\Vendors\Requests\RegisterRequest;
use modules\Vendors\Requests\UpdatePasswordRequest;
use modules\Vendors\Requests\UpdateVendorRequest;


class VendorController extends BaseController
{
    use ApiDesignTrait;


    private $CategoryInterface;
    private $vendorInterface;

    public function __construct(VendorInterface $vendorInterface)
    {
        $this->vendorInterface = $vendorInterface;
    }



    public function register(RegisterRequest $request){
//        return('ss');
        return $this->vendorInterface->register($request);
    }


    public function login(LoginRequest $request){
        return $this->vendorInterface->login($request);
    }




    public function logout(){
        return $this->vendorInterface->logout();
    }


    public function updatePassword(UpdatePasswordRequest $request){
        return $this->vendorInterface->updatePassword($request);
    }


    public function allVendors(){
        return $this->vendorInterface->allVendors();
//        return('sss');
    }


    public function vendorDetails(Request $request){
        return $this->vendorInterface->vendorDetails($request);
    }


    public function updateVendor(UpdateVendorRequest $request){
        return $this->vendorInterface->updateVendor($request);
    }



    public function softDeleteVendor(Request $request){
        return $this->vendorInterface->softDeleteVendor($request);
    }


    public function restoreVendor(Request $request){
        return $this->vendorInterface->restoreVendor($request);
    }


}
