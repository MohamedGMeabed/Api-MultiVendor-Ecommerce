<?php


namespace modules\Images\Controllers;

use App\Http\Traits\ApiDesignTrait;
use App\Http\Traits\ApiResponseTrait;
use App\Rules\MatchOldPassword;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\{
    Hash, Validator
};
use modules\BaseController;
use modules\Images\Interfaces\ImageInterface;


class ImageController extends BaseController
{
    use ApiDesignTrait;

    private $ImageInterface;

    public function __construct(ImageInterface $ImageInterface)
    {
        $this->ImageInterface = $ImageInterface;
    }

    public function create(){

        return $this->OrderInterface->create();
    }
}
?>
