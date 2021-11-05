<?php

namespace modules\Reviews\Repositories;

use App\Http\Interfaces\AuthInterface;
use App\Http\Traits\ApiDesignTrait;



use Illuminate\Http\Request;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use modules\Reviews\Interfaces\ReviewInterface;
use modules\Reviews\Models\Review;

class ReviewRepository implements ReviewInterface
{

    use ApiDesignTrait;



    public function __construct()
    {

    }

    /**
     * @OA\Get(
     *      path="/api/reviews",
     *      operationId="get all reviews",
     *      tags={"Reviews"},
     *      summary="Get list of reviews",
     *      description="Returns list of reviews",
     *     security={ {"sanctum": {} }},
     *      @OA\Response(
     *          response=200,
     *          description="All Reviews",
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

    public function allReviews()
    {
        // TODO: Implement allReviews() method.
        $user = auth('sanctum')->user();

        $userReviews = Review::where('user_id', $user->id)->with('product')->get();
        if(!is_null($userReviews)){
            return $this->ApiResponse(200, 'All reviews', null, $userReviews);
        }
        return $this->ApiResponse(400, 'No Reviews for this user');
    }

    /**
     * @OA\Get(
     *      path="/api/reviews/show",
     *      operationId="show specific Review",
     *      tags={"Reviews"},
     *      summary="show specific review",
     *      description="show specific review",
     *     security={ {"sanctum": {} }},
     *   @OA\Parameter(
     *    name="review_id",
     *    in="query",
     *    required=true,
     *    description="Enter review id",
     *    ),
     *      @OA\Response(
     *          response=200,
     *          description="review details",
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

    public function reviewDetails($request)
    {
        // TODO: Implement reviewDetails() method.
        $review = Review::with('product')->find($request->review_id);
        return $this->ApiResponse(200, 'Review Details', null, $review);

    }

    /**
     * @OA\Post(
     *      path="/api/reviews/create",
     *      operationId="create new review",
     *      tags={"Reviews"},
     *      summary="Create new Review",
     *      description="Add new Review",
     *      security={ {"sanctum": {} }},
     *      @OA\RequestBody(
     *          required=true,
     *          description="Pass Review credentials",
     *          @OA\JsonContent(
     *              required={"review", "product_id"},
     *              @OA\Property(property="review", type="string", format="review", example="good"),
     *              @OA\Property(property="product_id", type="integer", format="product_id", example="1"),
     *          ),
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Review created successfully",
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


    public function createReview($request)
    {
        // TODO: Implement createReview() method.
        // TODO: Implement createRate() method.
        $user = auth('sanctum')->user();

        Review::create([
            'review' => $request->review,
            'product_id' => $request->product_id,
            'user_id' => $user->id,
        ]);
        return $this->apiResponse(200, 'Review created successfully');
    }

    /**
     * @OA\Post(
     *      path="/api/reviews/edit",
     *      operationId="update review",
     *      tags={"Reviews"},
     *      summary="Update review",
     *      description="Edit review",
     *     security={ {"sanctum": {} }},
     *      @OA\RequestBody(
     *          required=true,
     *          description="Pass review credentials",
     *          @OA\JsonContent(
     *              required={"product_id", "review_id"},
     *              @OA\Property(property="review_id", type="integer", format="review_id", example="1"),
     *              @OA\Property(property="product_id", type="integer", format="product_id", example="1"),
     *              @OA\Property(property="review", type="string",  example="3"),
     *          ),
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Review update successfully",
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
    public function updateReview($request)
    {
        // TODO: Implement updateReview() method.
        $user = auth('sanctum')->user();
        $review = Review::find($request->review_id);
        $review->update([
            'review_id' => $request->review_id,
            'review' => $request->review,
            'product_id' => $request->product_id,
            'user_id' => $user->id,
        ]);
        return $this->apiResponse(200, 'Review updated successfully');
    }

    /**
     * @OA\Post(
     *      path="/api/reviews/delete",
     *      operationId="delete specific review",
     *      tags={"Reviews"},
     *      summary="Soft delete review",
     *      description="Soft delete review",
     *     security={ {"sanctum": {} }},
     *      @OA\RequestBody(
     *          required=true,
     *          description="Pass review credentials",
     *          @OA\JsonContent(
     *              required={"review_id"},
     *              @OA\Property(property="review_id", type="integer", format="review_id", example="1"),
     *          ),
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Review deleted successfully",
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
    public function softDeleteReview($request)
    {
        // TODO: Implement softDeleteReview() method.
        $review = Review::find($request->review_id);
        if (is_null($review)) {
            return $this->ApiResponse(400, 'No Review Found');
        }
        $review->delete();
        return $this->apiResponse(200,'Review deleted successfully');
    }

    /**
     * @OA\Post(
     *      path="/api/reviews/restore",
     *      operationId="restore specific review",
     *      tags={"Reviews"},
     *      summary="Restore delete review",
     *      description="restore review",
     *     security={ {"sanctum": {} }},
     *      @OA\RequestBody(
     *          required=true,
     *          description="Pass review credentials",
     *          @OA\JsonContent(
     *              required={"review_id"},
     *              @OA\Property(property="review_id", type="integer", format="review_id", example="1"),
     *          ),
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Review restored successfully",
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

    public function restoreReview($request)
    {
        // TODO: Implement restoreReview() method.
        $review = Review::withTrashed()->find($request->review_id);
        if (!is_null($review->deleted_at)) {
            $review->restore();
            return $this->ApiResponse(200,'Review restored successfully');
        }
        return $this->ApiResponse(200,'Review already restored');
    }
}
