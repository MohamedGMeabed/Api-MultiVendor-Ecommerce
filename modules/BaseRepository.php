<?php

namespace modules;

use App\Http\Interfaces\AuthInterface;
use App\Http\Traits\ApiDesignTrait;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

class BaseRepository
{
    use ApiDesignTrait;

    public function auth($guard, $data)
    {
        if (auth()->guard($guard)->attempt($data)) {
            $vendor = auth()->guard($guard)->user();
            if ($vendor->deleted_at != Null) {
                return "validation error";
            } else {
                $token = $vendor->createToken('token-name')->plainTextToken;
                return $this->ApiResponse(200, 'Done', null, $token);
            }
        }
        return $this->ApiResponse(401, 'Bad credentials');
    }
}
