<?php

namespace modules\Rates\Repositories;

use App\Http\Interfaces\AuthInterface;
use App\Http\Traits\ApiDesignTrait;

use modules\Rates\Repositories;;


use Illuminate\Http\Request;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use modules\Rates\Interfaces\RateInterface;
use modules\Rates\Models\Rate;
use function PHPUnit\Framework\isEmpty;
use function PHPUnit\Framework\isNull;

class RateRepository implements RateInterface
{

    use ApiDesignTrait;

    public function __construct()
    {

    }

    /**
     * @OA\Get(
     *      path="/api/rates",
     *      operationId="get all rates",
     *      tags={"Rates"},
     *      summary="Get list of rates",
     *      description="Returns list of rates",
     *     security={ {"sanctum": {} }},
     *      @OA\Response(
     *          response=200,
     *          description="All rates",
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

    public function allRates()
    {
        // TODO: Implement allRates() method.
        $user = auth('sanctum')->user();

        $userRates = Rate::where('user_id', $user->id)->with('product')->get();
        if(!is_null($userRates)){
            return $this->ApiResponse(200, 'All Rates', null, $userRates);
        }
        return $this->ApiResponse(400, 'No Rates for this user');
    }

    /**
     * @OA\Get(
     *      path="/api/rates/show",
     *      operationId="show specific Rate",
     *      tags={"Rates"},
     *      summary="show specific rate",
     *      description="show specific rate",
     *     security={ {"sanctum": {} }},
     *   @OA\Parameter(
     *    name="rate_id",
     *    in="query",
     *    required=true,
     *    description="Enter rate id",
     *    ),
     *      @OA\Response(
     *          response=200,
     *          description="rate details",
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

    public function ratesDetails($request)
    {
        // TODO: Implement ratesDetails() method.
        $rate = Rate::with('product')->find($request->rate_id);
        return $this->ApiResponse(200, 'Rate Details', null, $rate);
    }

    /**
     * @OA\Post(
     *      path="/api/rates/create",
     *      operationId="create new rate",
     *      tags={"Rates"},
     *      summary="Create new Rate",
     *      description="Add new Rate",
     *      security={ {"sanctum": {} }},
     *      @OA\RequestBody(
     *          required=true,
     *          description="Pass Rate credentials",
     *          @OA\JsonContent(
     *              required={"rate", "product_id"},
     *              @OA\Property(property="rate", type="string", format="rate", example="1"),
     *              @OA\Property(property="product_id", type="integer", format="product_id", example="1"),
     *          ),
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Rate created successfully",
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

    public function createRate($request)
    {
        // TODO: Implement createRate() method.
        $user = auth('sanctum')->user();

        Rate::create([
            'rate' => $request->rate,
            'product_id' => $request->product_id,
            'user_id' => $user->id,
        ]);
        return $this->apiResponse(200, 'Rate created successfully');
    }

    /**
     * @OA\Post(
     *      path="/api/rates/edit",
     *      operationId="update rate",
     *      tags={"Rates"},
     *      summary="Update rate",
     *      description="Edit rate",
     *     security={ {"sanctum": {} }},
     *      @OA\RequestBody(
     *          required=true,
     *          description="Pass rate credentials",
     *          @OA\JsonContent(
     *              required={"product_id", "rate_id"},
     *              @OA\Property(property="rate_id", type="integer", format="rate_id", example="1"),
     *              @OA\Property(property="product_id", type="integer", format="product_id", example="1"),
     *              @OA\Property(property="rate", type="string",  example="3"),
     *          ),
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Rate update successfully",
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


    public function updateRate($request)
    {
        // TODO: Implement updateRate() method.
        $user = auth('sanctum')->user();
        $rate = Rate::find($request->rate_id);
        $rate->update([
            'rate_id' => $request->rate_id,
            'rate' => $request->rate,
            'product_id' => $request->product_id,
            'user_id' => $user->id,
        ]);
        return $this->apiResponse(200, 'Rate updated successfully');
    }

    /**
     * @OA\Post(
     *      path="/api/rates/delete",
     *      operationId="delete specific rate",
     *      tags={"Rates"},
     *      summary="Soft delete rate",
     *      description="Soft delete rate",
     *     security={ {"sanctum": {} }},
     *      @OA\RequestBody(
     *          required=true,
     *          description="Pass rate credentials",
     *          @OA\JsonContent(
     *              required={"rate_id"},
     *              @OA\Property(property="rate_id", type="integer", format="rate_id", example="1"),
     *          ),
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Rate deleted successfully",
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

    public function softDeleteRate($request)
    {
        // TODO: Implement softDeleteRate() method.
        $rate = Rate::find($request->rate_id);
        if (is_null($rate)) {
            return $this->ApiResponse(400, 'No Rate Found');
        }
        $rate->delete();
        return $this->apiResponse(200,'Rate deleted successfully');
    }

    /**
     * @OA\Post(
     *      path="/api/rates/restore",
     *      operationId="restore specific rate",
     *      tags={"Rates"},
     *      summary="Restore delete rate",
     *      description="restore rate",
     *     security={ {"sanctum": {} }},
     *      @OA\RequestBody(
     *          required=true,
     *          description="Pass rate credentials",
     *          @OA\JsonContent(
     *              required={"rate_id"},
     *              @OA\Property(property="rate_id", type="integer", format="rate_id", example="1"),
     *          ),
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Rate restored successfully",
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


    public function restoreRate($request)
    {
        // TODO: Implement restoreRate() method.
        $rate = Rate::withTrashed()->find($request->rate_id);
        if (!is_null($rate->deleted_at)) {
            $rate->restore();
            return $this->ApiResponse(200,'Rate restored successfully');
        }
        return $this->ApiResponse(200,'Rate already restored');
    }
}
