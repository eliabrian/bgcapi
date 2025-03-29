<?php

namespace App\Http\Controllers\Api\V1\Game;

use App\Http\Controllers\Controller;
use App\Http\Requests\Game\StoreGameRequest;
use App\Http\Resources\GameResource;
use App\Models\Game;
use App\Traits\Response;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StoreController extends Controller
{
    use Response;

    public function __invoke(StoreGameRequest $request): GameResource|JsonResponse
    {
        try {
            $validated = $request->safe()->only([
                'name',
                'slug',
                'tag_id',
                'difficulty_id',
                'player_min',
                'player_max',
                'age',
                'duration',
                'summary',
                'description',
            ]);

            $created = DB::transaction(fn () => Game::query()->create(
                attributes: [
                    ...$validated,
                ]
            ));

            return new GameResource($created);
        } catch (\Exception $e) {
            return $this->responseError($e);
        }
    }
}
