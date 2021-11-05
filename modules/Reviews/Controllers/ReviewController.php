<?php


namespace modules\Reviews\Controllers;

use App\Http\Traits\ApiDesignTrait;
use App\Http\Traits\ApiResponseTrait;
use App\Rules\MatchOldPassword;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\{
    Hash, Validator
};
use modules\BaseController;
use modules\Reviews\Interfaces\ReviewInterface;
use modules\Reviews\Requests\CreateReviewRequest;
use modules\Reviews\Requests\DeleteRequest;
use modules\Reviews\Requests\RestoreRequest;
use modules\Reviews\Requests\ShowRequest;
use modules\Reviews\Requests\UpdateReviewRequest;


class ReviewController extends BaseController
{
    use ApiDesignTrait;

    private $reviewInterface;

    public function __construct(ReviewInterface $reviewInterface)
    {
        $this->reviewInterface = $reviewInterface;
    }


    public function allReviews(){
        return $this->reviewInterface->allReviews();
    }

    public function reviewDetails(ShowRequest $request){
        return $this->reviewInterface->reviewDetails($request);
    }

    public function createReview(CreateReviewRequest $request){
        return $this->reviewInterface->createReview($request);
    }

    public function updateReview(UpdateReviewRequest $request){
        return $this->reviewInterface->updateReview($request);
    }

    public function softDeleteReview(DeleteRequest $request){
        return $this->reviewInterface->softDeleteReview($request);
    }

    public function restoreReview(RestoreRequest $request){
        return $this->reviewInterface->restoreReview($request);
    }
}
?>
