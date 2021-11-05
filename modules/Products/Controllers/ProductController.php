<?php


namespace modules\Products\Controllers;

use App\Http\Traits\ApiResponseTrait;
use App\Rules\MatchOldPassword;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\{
    Cache,
    Hash, Redis, Validator
};
use modules\BaseController;
use modules\Products\Interfaces\ProductInterface;

use modules\Products\Repositories\ProductRepository;
use modules\Products\Requests\UpdateProductRequest;
use modules\Products\Requests\StoreProductRequest;
use modules\Products\Models\Product;


class ProductController extends BaseController
{

    private $repo;

    public function __construct(ProductRepository $productRepository)
    {
        $this->repo = $productRepository;
    }


    public function index() {
        return $this->repo->index();
    }

    public function allProduct(){
        $cachingValue = Redis::get('products');
        if(isset($cachingValue)){
            $data = json_decode($cachingValue);
            return $this->ApiResponse(200,'Error',Null,null);
        }else{
            $product =Product::all();
            Redis::set('products', $product);
            return $this->ApiResponse(200,'Error',Null,$product);
        }
    //    return Redis::get('products');
    //    return Redis::del('products');
    }

    public function store(StoreProductRequest $request)
    {
        return $this->repo->store($request);

    }

    public function update(Product $product, UpdateProductRequest $request)
    {
        return $this->repo->update($product,$request);

    }

    public function show(Product $product)
    {
        return $this->repo->show($product);

    }

    public function destroy(product $product)
    {
        return $this->repo->destroy($product);
    }

    public function search(Request $request)
    {
        return $this->repo->search($request);
    }

    public function notFound()
    {
        return $this->repo->notFound();
    }
}
