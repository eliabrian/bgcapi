<?php

namespace App\Http\Controllers\Api\V1\Game;

use App\Http\Controllers\Controller;
use App\Http\Resources\GameCollection;
use App\Repositories\GameRepository;
use App\Traits\Response;
use Illuminate\Http\JsonResponse;

class IndexController extends Controller
{
    use Response;

    public GameRepository $game;

    public function __construct(GameRepository $game)
    {
        $this->game = $game;
    }

    public function __invoke(): GameCollection|JsonResponse
    {
        try {
            return new GameCollection($this->game->all());
        } catch (\Exception $e) {
            return $this->responseError($e);
        }
    }
}
