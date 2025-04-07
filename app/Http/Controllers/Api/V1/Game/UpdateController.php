<?php

namespace App\Http\Controllers\Api\V1\Game;

use App\Http\Controllers\Controller;
use App\Http\Requests\Game\UpdateGameRequest;
use App\Http\Resources\GameResource;
use App\Repositories\GameRepository;
use App\Traits\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UpdateController extends Controller
{
    use Response;

    public GameRepository $game;

    public function __construct(GameRepository $game)
    {
        $this->game = $game;
    }

    public function __invoke(string $id, UpdateGameRequest $request)
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

            $game = $this->game->get($id);

            DB::transaction(fn () => $game->update(
                [
                    ...$validated,
                ]
            ));

            return new GameResource($game);
        } catch (\Exception $e) {
            return $this->responseError($e);
        }
    }
}
