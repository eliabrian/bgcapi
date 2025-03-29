<?php

namespace App\Http\Controllers\Api\V1\Game;

use App\Http\Controllers\Controller;
use App\Http\Resources\GameResource;
use App\Repositories\GameRepository;
use App\Traits\Response;
use Illuminate\Http\JsonResponse;

class ShowController extends Controller
{
    use Response;

    public GameRepository $game;

    public function __construct(GameRepository $game)
    {
        $this->game = $game;
    }

    public function __invoke(string $id): GameResource|JsonResponse
    {
        try {
            return new GameResource($this->game->get($id));
        } catch (\Exception $e) {
            return $this->responseError($e);
        }
    }
}
