<?php
namespace modules\Specs\Interfaces;


use modules\Specs\Requests\StoreSpecRequest;
use modules\Specs\Requests\UpdateSpecRequest;
use modules\Specs\Models\Spec;

interface SpecInterface {

    public function index();

    public function store(Spec $spec, StoreSpecRequest $request);

    public function update(Spec $spec, UpdateSpecRequest $request);

    public function show(Spec $spec);

    public function destroy(Spec $spec);


}
