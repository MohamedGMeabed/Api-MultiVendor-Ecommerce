<?php

namespace modules\Admins\Controllers;




use modules\Admins\Interfaces\AdminInterface;
use modules\Admins\Models\Admin;
use modules\Admins\Repositories\AdminRepository;
use modules\Admins\Requests\LoginAdminRequest;
use modules\Admins\Requests\StoreAdminRequest;
use modules\Admins\Requests\UpdateAdminRequest;
use modules\BaseController;

class AdminController extends BaseController implements AdminInterface

{

    private $repo;

    public function __construct(AdminRepository $adminRepository)
    {
        $this->repo = $adminRepository;
    }

    public function login (LoginAdminRequest $request) {
        return $this->repo->login($request);
    }

    public function index() {
        $user = auth('sanctum')->user();
        $this->authorizeForUser($user,'viewAny', Admin::class);
        return $this->repo->index();
    }

    public function store(StoreAdminRequest $request){
        return $this->repo->store($request);
    }

    public function update(Admin $admin, UpdateAdminRequest $request){
        return $this->repo->update($admin,$request);
    }

    public function show(Admin $admin){
        $user = auth('sanctum')->user();
        $this->authorizeForUser($user,'view', $admin);
        return $this->repo->show($admin);
    }

    public function destroy(Admin $admin){
        $user = auth('sanctum')->user();
        $this->authorizeForUser($user,'delete', $admin);
        return $this->repo->destroy($admin);
    }

    public function logout() {
        return $this->repo->logout();
    }

    public function notFound()
    {
        return $this->repo->notFound();
    }
}

