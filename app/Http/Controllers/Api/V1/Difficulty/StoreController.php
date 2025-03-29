<?php

namespace App\Http\Controllers\Api\V1\Difficulty;

use App\Http\Controllers\Controller;
use App\Http\Requests\Difficulty\StoreDifficultyRequest;
use App\Http\Resources\DifficultyResource;
use App\Models\Difficulty;
use App\Traits\Response;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;

class StoreController extends Controller
{
    use Response;

    public function __invoke(StoreDifficultyRequest $request): DifficultyResource|JsonResponse
    {
        try {
            $validated = $request->safe()->only([
                'name',
                'slug',
            ]);

            $created = DB::transaction(fn () => Difficulty::query()->create(
                attributes: [
                    ...$validated,
                ]
            ));

            return new DifficultyResource($created);
        } catch (\Exception $e) {
            return $this->responseError($e);
        }
    }
}
