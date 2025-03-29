<?php

namespace App\Http\Controllers\Api\V1\Tag;

use App\Http\Controllers\Controller;
use App\Http\Resources\TagCollection;
use App\Repositories\TagRepository;
use App\Traits\Response;
use Illuminate\Http\JsonResponse;

class IndexController extends Controller
{
    use Response;

    public TagRepository $tag;

    public function __construct(TagRepository $tag)
    {
        $this->tag = $tag;
    }

    public function __invoke(): TagCollection|JsonResponse
    {
        try {
            return new TagCollection($this->tag->all());
        } catch (\Exception $e) {
            return $this->responseError($e);
        }
    }
}
