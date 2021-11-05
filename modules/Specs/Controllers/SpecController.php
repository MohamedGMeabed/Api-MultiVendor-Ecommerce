<?php


namespace modules\Specs\Controllers;

use modules\Specs\Interfaces\SpecInterface;
use modules\Specs\Repositories\SpecRepository;
use modules\Specs\Requests\UpdateSpecRequest;
use modules\Specs\Requests\StoreSpecRequest;
use modules\Specs\Models\Spec;
use modules\BaseController;


class SpecController extends BaseController
{

    private $repo;

    public function __construct(SpecRepository $SpecRepository)
    {
        $this->repo = $SpecRepository;
    }
    public function index() {
        return $this->repo->index();
    }

    public function store(Spec $spec, StoreSpecRequest $request)
    {
        return $this->repo->store($spec,$request);

    }

    public function update(Spec $spec, UpdateSpecRequest $request)
    {
        return $this->repo->update($spec,$request);

    }

    public function show(Spec $spec)
    {
        return $this->repo->show($spec);

    }

    public function destroy(Spec $spec)
    {
        return $this->repo->destroy($spec);
    }
    public function notFound()
    {
        return $this->repo->notFound();
    }
}
