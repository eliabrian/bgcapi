<?php

namespace App\Http\Controllers\Api\V1\Difficulty;

use App\Http\Controllers\Controller;
use App\Repositories\DifficultyRepository;
use App\Traits\Response;
use Illuminate\Support\Facades\DB;

class DestroyController extends Controller
{
    use Response;

    public DifficultyRepository $difficulty;

    public function __construct(DifficultyRepository $difficulty)
    {
        $this->difficulty = $difficulty;
    }

    public function __invoke(string $id)
    {
        try {
            $difficulty = $this->difficulty->get($id);

            DB::transaction(fn () => $difficulty->delete());

            return $this->responseSuccess(
                [
                    'result' => 'ok',
                    'message' => 'Difficulty deleted!',
                ]
            );
        } catch (\Exception $e) {
            return $this->responseError($e);
        }
    }
}
