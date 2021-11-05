<?php

namespace modules\Vendors\Repositories;

use App\Http\Traits\ApiDesignTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use modules\BaseRepository;
use modules\Vendors\Interfaces\VendorInterface;
use modules\Vendors\Models\Vendor;

class VendorRepository extends BaseRepository implements VendorInterface
{

    use ApiDesignTrait;

    /**
     * @OA\Post(
     * path="/api/vendors/register",
     * summary="register",
     * description="register by name , email and password",
     * operationId="authLogin",
     * tags={"Vendors"},
     * @OA\RequestBody(
     *    required=true,
     *    description="Fill your Data",
     *    @OA\JsonContent(
     *       required={"name", "email", "password", "contact", "country_id", "city_id"},
     *       @OA\Property(property="name", type="string", example="vendor"),
     *       @OA\Property(property="email", type="string", format="email", example="vendor@mail.com"),
     *       @OA\Property(property="password", type="string", format="password", example="123456"),
     *       @OA\Property(property="contact", type="string", example="123456"),
     *       @OA\Property(property="country_id", type="integer", format="country_id", example="1"),
     *       @OA\Property(property="city_id", type="integer", format="city_id", example="1"),
     *       @OA\Property(property="persistent", type="boolean", example="true"),
     *    ),
     * ),
     * @OA\Response(
     *     response=200,
     *     description="Success",
     *     @OA\JsonContent(
     *        @OA\Property(property="user", type="object", ref="#/components/schemas/User"),
     *     )
     *  ),
     * @OA\Response(
     *    response=422,
     *    description="Wrong credentials response",
     *    @OA\JsonContent(
     *       @OA\Property(property="message", type="string", example="Sorry, wrong email address or password. Please try again")
     *        )
     *     )
     * )
     *
     */

    public function register($request)
    {
        Vendor::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'contact' => $request->contact,
            'country_id' => $request->country_id,
            'city_id' => $request->city_id,
        ]);
        return $this->ApiResponse(200, 'You have signed-in');
    }


    /**
     * @OA\Post(
     * path="/api/vendors/login",
     * summary="Sign in",
     * description="Login by email and password",
     * operationId="authLogin",
     * tags={"Vendors"},
     * @OA\RequestBody(
     *    required=true,
     *    description="Pass user credentials",
     *    @OA\JsonContent(
     *       required={"email","password"},
     *       @OA\Property(property="email", type="string", format="email", example="vendor@gmail.com"),
     *       @OA\Property(property="password", type="string", format="password", example="123456"),
     *       @OA\Property(property="persistent", type="boolean", example="true"),
     *    ),
     * ),
     * @OA\Response(
     *     response=200,
     *     description="Success",
     *     @OA\JsonContent(
     *        @OA\Property(property="user", type="object", ref="#/components/schemas/User"),
     *     )
     *  ),
     * @OA\Response(
     *    response=422,
     *    description="Wrong credentials response",
     *    @OA\JsonContent(
     *       @OA\Property(property="message", type="string", example="Sorry, wrong email address or password. Please try again")
     *        )
     *     )
     * )
     */


    public function login($request)
    {
        // TODO: Implement login() method.

        $data = ["email" => $request->email, "password" => $request->password];
        return $this->auth('vendors', $data);
    }

    /**
     * @OA\Post(
     * path="/api/vendors/logout",
     * summary="Logout",
     * description="Logout by email, password",
     * operationId="authLogout",
     * tags={"Vendors"},
     * security={ {"sanctum": {} }},
     * @OA\Response(
     *     response=200,
     *     description="Success",
     *     @OA\JsonContent(
     *        @OA\Property(property="user", type="object", ref="#/components/schemas/User"),
     *     )
     *  ),
     * @OA\Response(
     *    response=422,
     *    description="Wrong credentials response",
     *    @OA\JsonContent(
     *       @OA\Property(property="message", type="string", example="Sorry, wrong email address or password. Please try again")
     *        )
     *     )
     * )
     */

    public function logout()
    {
        // TODO: Implement logout() method.
        $vendor = auth('sanctum')->user();
        $vendor->tokens()->where('id', $vendor->currentAccessToken()->id)->delete();
        return $this->ApiResponse(200, 'Logged out');
    }


    /**
     * @OA\Post(
     *      path="/api/vendors/update-password",
     *      operationId="update password",
     *      tags={"Vendors"},
     *      summary="Update Password",
     *      description="Update Password",
     *     security={ {"sanctum": {} }},
     *      @OA\RequestBody(
     *          required=true,
     *          description="Pass vendor credentials",
     *          @OA\JsonContent(
     *              required={"old_password", "new_password"},
     *              @OA\Property(property="old_password", type="string", format="old_password", example="12345678"),
     *              @OA\Property(property="new_password", type="string", format="new_password", example="123456789"),
     *          ),
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Password update successfully",
     *       ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthenticated",
     *      ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden"
     *      ),
     *        @OA\Response(
     *          response=400,
     *          description="Validation Error"
     *      )
     *     )
     */

    public function updatePassword($request)
    {
        // TODO: Implement updatePassword() method.

        Vendor::find(auth('sanctum')->user()->id)->update([
            'password' => Hash::make($request->new_password),
        ]);
        return $this->apiResponse(200, 'Password updated successfully');
    }

    /**
     * @OA\Get(
     *      path="/api/vendors",
     *      operationId="get all vendors",
     *      tags={"Vendors"},
     *      summary="Get list of vendors",
     *      description="Returns list of vendors",
     *     security={ {"sanctum": {} }},
     *      @OA\Response(
     *          response=200,
     *          description="All vendors",
     *       ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthenticated",
     *      ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden"
     *      )
     *     )
     */

    public function allVendors()
    {
        // TODO: Implement allVendors() method.
        $vendors = Vendor::with('countries')->with('cities')->get();
        return $this->ApiResponse(200, 'All Vendors', null, $vendors);
    }


    /**
     * @OA\Get(
     *      path="/api/vendors/show",
     *      operationId="show specific Vendor",
     *      tags={"Vendors"},
     *      summary="show specific vendor",
     *      description="show specific vendor",
     *     security={ {"sanctum": {} }},
     *      @OA\Response(
     *          response=200,
     *          description="User details",
     *       ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthenticated",
     *      ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden"
     *      ),
     *        @OA\Response(
     *          response=400,
     *          description="Validation Error"
     *      )
     *     )
     */

    public function vendorDetails($request)
    {
        // TODO: Implement vendorDetails() method.
        $vendor = auth('sanctum')->user();
        $vendor = $vendor->with('countries')->with('cities')->first();
        return $this->ApiResponse(200, 'Vendor details', null, $vendor);
    }

    /**
     * @OA\Post(
     *      path="/api/vendors/edit",
     *      operationId="update vendor",
     *      tags={"Vendors"},
     *      summary="Update Vendor",
     *      description="Edit vendor",
     *     security={ {"sanctum": {} }},
     *      @OA\RequestBody(
     *          required=true,
     *          description="Pass vendor credentials",
     *          @OA\JsonContent(
     *              required={"name", "email", "password", "contact", "country_id", "city_id"},
     *              @OA\Property(property="name", type="string",  example="user"),
     *              @OA\Property(property="email", type="string", format="email", example="user@gmail.com"),
     *              @OA\Property(property="password", type="string", format="password", example="123456"),
     *              @OA\Property(property="contact", type="string", example="01000"),
     *              @OA\Property(property="country_id", type="integer", format="country_id", example="1"),
     *              @OA\Property(property="city_id", type="integer", format="city_id", example="1"),
     *          ),
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Vendor update successfully",
     *       ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthenticated",
     *      ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden"
     *      ),
     *        @OA\Response(
     *          response=400,
     *          description="Validation Error"
     *      )
     *     )
     */

    public function updateVendor($request)
    {
        // TODO: Implement updateVendor() method.

        $vendor = auth('sanctum')->user();
        $vendor->update([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'contact' => $request->contact,
            'country_id' => $request->country_id,
            'city_id' => $request->city_id,
        ]);
        return $this->apiResponse(200, 'Vendor updated successfully');
    }

    /**
     * @OA\Post(
     *      path="/api/vendors/delete",
     *      operationId="delete specific vendor",
     *      tags={"Vendors"},
     *      summary="Soft delete vendor",
     *      description="Soft delete vendor",
     *     security={ {"sanctum": {} }},
     *      @OA\RequestBody(
     *          required=true,
     *          description="Pass vendor credentials",
     *          @OA\JsonContent(
     *              required={"vendor_id"},
     *              @OA\Property(property="vendor_id", type="integer", format="vendor_id", example="1"),
     *          ),
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Vendor deleted successfully",
     *       ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthenticated",
     *      ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden"
     *      ),
     *        @OA\Response(
     *          response=400,
     *          description="Validation Error"
     *      )
     *     )
     */

    public function softDeleteVendor($request)
    {
        // TODO: Implement softDeleteVendor() method.
        $vendor = Vendor::find($request->vendor_id);
        if (is_null($vendor)) {
            return $this->ApiResponse(400, 'No Vendor Found');
        }
        $vendor->delete();
        return $this->apiResponse(200,'Vendor deleted successfully');
    }

    /**
     * @OA\Post(
     *      path="/api/vendors/restore",
     *      operationId="restore specific vendor",
     *      tags={"Vendors"},
     *      summary="Restore delete vendor",
     *      description="restore vendor",
     *     security={ {"sanctum": {} }},
     *      @OA\RequestBody(
     *          required=true,
     *          description="Pass vendor credentials",
     *          @OA\JsonContent(
     *              required={"vendor_id"},
     *              @OA\Property(property="vendor_id", type="integer", format="vendor_id", example="1"),
     *          ),
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Vendor restored successfully",
     *       ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthenticated",
     *      ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden"
     *      ),
     *        @OA\Response(
     *          response=400,
     *          description="Validation Error"
     *      )
     *     )
     */

    public function restoreVendor($request)
    {
        // TODO: Implement restoreVendor() method.
        $vendor = Vendor::withTrashed()->find($request->vendor_id);
        if (!is_null($vendor->deleted_at)) {
            $vendor->restore();
            return $this->ApiResponse(200,'Vendor restored successfully');
        }
        return $this->ApiResponse(200,'Vendor already restored');
    }

}
