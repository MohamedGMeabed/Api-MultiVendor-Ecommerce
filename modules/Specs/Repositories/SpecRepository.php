<?php

namespace modules\Specs\Repositories;

use Symfony\Component\HttpFoundation\Response;
use modules\Specs\Requests\UpdateSpecRequest;
use modules\Specs\Requests\StoreSpecRequest;
use modules\Specs\Interfaces\SpecInterface;
use App\Http\Traits\ApiDesignTrait;
use modules\Specs\Models\Spec;
use Exception;

class SpecRepository implements SpecInterface
{
    use ApiDesignTrait;

    /**
     * @OA\Get(
     *      path="/api/specs",
     *      operationId="index",
     *      tags={"Spec"},
     *      summary="Get list of specs",
     *      description="Returns list of specs Data",
     *      security={ {"sanctum": {} }},
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *         @OA\JsonContent(
     *              @OA\Property(property="specs", type="object", ref="#/components/schemas/Spec"),
     *          )
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
    public function index()
    {
//        $this->authorizeForUser($user,'can', [User::class,'index-spec']);
        try {
            $specs = Spec::all();
            return $this->ApiResponse(Response::HTTP_OK, null,Null,$specs);
        } catch (Exception $e) {
            return $this->ApiResponse(Response::HTTP_NO_CONTENT, 'No provided data ');
        }
    }

    /**
     * @OA\Post(
     * path="/api/specs",
     * summary="new Spec",
     * description="store new Spec",
     * operationId="store",
     * tags={"Spec"},
     * security={ {"sanctum": {} }},
     * @OA\RequestBody(
     *    required=true,
     *    description="Pass new spec name",
     *    @OA\JsonContent(
     *       required={"name"},
     *       @OA\Property(property="name", type="string", format="string", example="color")
     *    ),
     * ),
     * @OA\Response(
     *     response=200,
     *     description="Success",
     *     @OA\JsonContent(
     *         @OA\Property(property="message", type="string", example="spec created")
     *     )
     *  ),
     * @OA\Response(
     *    response=422,
     *    description="invalid input",
     *    @OA\JsonContent(
     *       @OA\Property(property="error", type="string", example="spec can't be created try later")
     *        )
     *     )
     * )
     *
     */
    public function store(Spec $spec, StoreSpecRequest $request)
    {
        try {
            $data = $request->all();
            $spec = Spec::create($data);
            return $this->ApiResponse(Response::HTTP_CREATED, "spec created successfully",null, $spec);
        }catch (Exception $e) {
            return $this->ApiResponse(500, 'spec can\'t be created try later');
        }
    }

    /**
     * @OA\Get(
     *      path="/api/specs/{spec}",
     *      operationId="show",
     *      tags={"Spec"},
     *      summary="Get specific Spec ",
     *      description="Returns specific Spec Data",
     *      security={ {"sanctum": {} }},
     *     @OA\Parameter(
     *          name="spec",
     *          description="spec id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *         @OA\JsonContent(
     *              @OA\Property(property="spec", type="object", ref="#/components/schemas/Spec"),
     *          )
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

    public function show(Spec $spec)
    {
        if ($spec->trashed()) {
            return $this->ApiResponse(Response::HTTP_NOT_FOUND, 'Spec was deleted',null);
        }
        $spec = Spec::find($spec->id);
        return $this->ApiResponse(Response::HTTP_OK,null,null,$spec);
    }

    /**
     * @OA\Put (
     * path="/api/specs/{spec}",
     * summary="update existing spec",
     * description="update spec",
     * operationId="updatespec",
     * tags={"Spec"},
     * security={ {"sanctum": {} }},
     *     @OA\Parameter(
     *          name="spec",
     *          description="spec id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     * @OA\RequestBody(
     *    required=true,
     *    description="update spec name",
     *    @OA\JsonContent(
     *       required={"name"},
     *       @OA\Property(property="name", type="string", format="string", example="color")
     *    ),
     * ),
     * @OA\Response(
     *     response=200,
     *     description="Success",
     *     @OA\JsonContent(
     *         @OA\Property(property="message", type="string", example="spec updated")
     *     )
     *  ),
     * @OA\Response(
     *    response=422,
     *    description="invalid input",
     *    @OA\JsonContent(
     *       @OA\Property(property="validation error", type="string", example="Sorry, invalid spec name")
     *        )
     *     )
     * )
     *
     */

    public function update(Spec $spec, UpdateSpecRequest $request)
    {
        try {
            $spec->update($request->all());
            return $this->ApiResponse(Response::HTTP_ACCEPTED, 'spec updated', null, $spec);
        } catch (Exception $e) {
            return $this->ApiResponse(500, 'Update process can not be complete, try later');
        }
    }

    /**
     * @OA\Delete(
     *      path="/api/specs/{spec}",
     *      operationId="destroy",
     *      tags={"Spec"},
     *      summary="Delete existing spec",
     *      description="Delete existing spec ",
     *      security={ {"sanctum": {} }},
     *      @OA\Parameter(
     *          name="spec",
     *          description="spec id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *     @OA\Response(
     *         response=200,
     *          description="Successful operation",
     *          @OA\JsonContent(
     *              @OA\Property(property="success", type="string", example="spec Moved to trash")
     *           )
     *      ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthenticated",
     *      ),
     * )
     *
     */
    public function destroy(Spec $spec)
    {
        if ($spec->trashed()) {
            return $this->ApiResponse(Response::HTTP_NOT_FOUND, 'Spec already deleted');
        }
        $spec->delete();
        return $this->ApiResponse(Response::HTTP_MOVED_PERMANENTLY, 'spec Moved to trash...' );
    }

    public function notFound()
    {
        return $this->ApiResponse(Response::HTTP_NOT_FOUND, null, 'THIS spec NOT EXIST.');
    }
}
