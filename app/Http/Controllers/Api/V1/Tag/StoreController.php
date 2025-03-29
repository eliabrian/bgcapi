<?php

namespace App\Http\Controllers\Api\V1\Tag;

use App\Http\Controllers\Controller;
use App\Http\Requests\Tag\StoreTagRequest;
use App\Http\Resources\TagResource;
use App\Models\Tag;
use App\Traits\Response;
use Illuminate\Http\JsonResponse;

class StoreController extends Controller
{
    use Response;

    public function __invoke(StoreTagRequest $request): JsonResponse
    {
        try {
            $validated = $request->safe()->only([
                'name',
                'slug',
            ]);

            $created = Tag::create($validated);

            return new TagResource($created)
                ->response();
        } catch (\Exception $e) {
            return $this->responseError($e);
        }
    }
}
