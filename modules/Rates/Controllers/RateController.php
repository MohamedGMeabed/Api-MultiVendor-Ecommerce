<?php


namespace modules\Rates\Controllers;

use App\Http\Traits\ApiDesignTrait;
use App\Http\Traits\ApiResponseTrait;
use App\Rules\MatchOldPassword;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\{
    Hash, Validator
};
use modules\BaseController;
use modules\Rates\Interfaces\RateInterface;
use modules\Rates\Requests\CreateRateRequest;
use modules\Rates\Requests\DeleteRequest;
use modules\Rates\Requests\RestoreRequest;
use modules\Rates\Requests\ShowRequest;
use modules\Rates\Requests\UpdateRateRequest;


class RateController extends BaseController
{
    use ApiDesignTrait;

    private $rateInterface;

    public function __construct(RateInterface $rateInterface)
    {
        $this->rateInterface = $rateInterface;
    }


    public function allRates(){
        return $this->rateInterface->allRates();
    }

    public function ratesDetails(ShowRequest $request){
        return $this->rateInterface->ratesDetails($request);
    }

    public function createRate(CreateRateRequest $request){
        return $this->rateInterface->createRate($request);
    }

    public function updateRate(UpdateRateRequest $request){
        return $this->rateInterface->updateRate($request);
    }

    public function softDeleteRate(DeleteRequest $request){
        return $this->rateInterface->softDeleteRate($request);
    }

    public function restoreRate(RestoreRequest $request){
        return $this->rateInterface->restoreRate($request);
    }
}
?>
