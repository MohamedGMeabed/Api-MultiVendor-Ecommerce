<?php
namespace modules\Admins\Interfaces;


use modules\Admins\Models\Admin;
use modules\Admins\Requests\LoginAdminRequest;
use modules\Admins\Requests\StoreAdminRequest;
use modules\Admins\Requests\UpdateAdminRequest;

interface AdminInterface {

    public function login (LoginAdminRequest $request);

    public function index();

    public function store (StoreAdminRequest $request);

    public function update (Admin $admin, UpdateAdminRequest $request);

    public function show (Admin $admin);

    public function destroy (Admin $admin);

    public function logout ();
}
