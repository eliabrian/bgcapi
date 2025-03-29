<?php

namespace App\Http\Controllers\Api\V1\Tag;

use App\Http\Controllers\Controller;
use App\Http\Resources\TagResource;
use App\Repositories\TagRepository;
use App\Traits\Response;
use Illuminate\Http\JsonResponse;

class ShowController extends Controller
{
    use Response;

    public TagRepository $tag;

    public function __construct(TagRepository $tag)
    {
        $this->tag = $tag;
    }

    public function __invoke(string $id): JsonResponse
    {
        try {
            return new TagResource($this->tag->get($id))
                ->response();
        } catch (\Exception $e) {
            return $this->responseError($e);
        }
    }
}
