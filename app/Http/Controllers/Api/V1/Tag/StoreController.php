<?php

namespace App\Http\Controllers\Api\V1\Tag;

use App\Http\Controllers\Controller;
use App\Http\Requests\Tag\StoreTagRequest;
use App\Http\Resources\TagResource;
use App\Models\Tag;
use App\Traits\Response;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;

class StoreController extends Controller
{
    use Response;

    public function __invoke(StoreTagRequest $request): TagResource|JsonResponse
    {
        try {
            $validated = $request->safe()->only([
                'name',
                'slug',
            ]);

            $created = DB::transaction(fn () => Tag::query()->create(
                attributes: [
                    ...$validated,
                ]
            ));

            return new TagResource($created);
        } catch (\Exception $e) {
            return $this->responseError($e);
        }
    }
}
