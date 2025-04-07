<?php

namespace App\Http\Controllers\Api\V1\Game;

use App\Http\Controllers\Controller;
use App\Repositories\GameRepository;
use App\Traits\Response;
use Illuminate\Support\Facades\DB;

class DestroyController extends Controller
{
    use Response;

    public GameRepository $game;

    public function __construct(GameRepository $game)
    {
        $this->game = $game;
    }

    public function __invoke(string $id)
    {
        try {
            $game = $this->game->get($id);

            DB::transaction(fn () => $game->delete());

            return $this->responseSuccess(
                [
                    'result' => 'ok',
                    'message' => 'Game deleted!',
                ]
            );
        } catch (\Exception $e) {
            return $this->responseError($e);
        }
    }
}
