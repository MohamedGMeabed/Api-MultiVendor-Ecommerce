<?php
namespace modules\Products\Interfaces;


use modules\Products\Requests\StoreProductRequest;
use modules\Products\Requests\UpdateProductRequest;
use modules\Products\Models\Product;

interface ProductInterface {


    public function index();

    public function store(StoreProductRequest $request);

    public function update(Product $product, UpdateProductRequest $request);

    public function show(Product $product);

    public function destroy(Product $product);

}
