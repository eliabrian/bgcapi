<?php

namespace App\Http\Controllers\Api\V1\Tag;

use App\Http\Controllers\Controller;
use App\Http\Requests\Tag\UpdateTagRequest;
use App\Http\Resources\TagResource;
use App\Repositories\TagRepository;
use App\Traits\Response;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;

class UpdateController extends Controller
{
    use Response;

    public TagRepository $tag;

    public function __construct(TagRepository $tag)
    {
        $this->tag = $tag;
    }

    public function __invoke(string $id, UpdateTagRequest $request): TagResource|JsonResponse
    {
        try {
            $validated = $request->safe()->only(['name', 'slug']);

            $tag = $this->tag->get($id);

            DB::transaction(fn () => $tag->update(
                [
                    ...$validated,
                ]
            ));

            return new TagResource($tag);
        } catch (\Exception $e) {
            return $this->responseError($e);
        }
    }
}
