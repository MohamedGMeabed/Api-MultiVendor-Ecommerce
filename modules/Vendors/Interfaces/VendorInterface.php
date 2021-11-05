<?php
namespace modules\Vendors\Interfaces;


interface VendorInterface {

    public function register($request);
    public function login($request);
    public function logout();
    public function updatePassword($request);

    public function allVendors();
    public function vendorDetails($request);
    public function updateVendor($request);

    public function softDeleteVendor($request);
    public function restoreVendor($request);

}
