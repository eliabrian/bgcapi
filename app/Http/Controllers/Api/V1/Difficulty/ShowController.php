<?php

namespace App\Http\Controllers\Api\V1\Difficulty;

use App\Http\Controllers\Controller;
use App\Http\Resources\DifficultyResource;
use App\Repositories\DifficultyRepository;
use App\Traits\Response;
use Illuminate\Http\JsonResponse;

class ShowController extends Controller
{
    use Response;

    public DifficultyRepository $difficulty;

    public function __construct(DifficultyRepository $difficulty)
    {
        $this->difficulty = $difficulty;
    }

    public function __invoke(string $id): JsonResponse
    {
        try {
            return new DifficultyResource($this->difficulty->get($id))
                ->response();
        } catch (\Exception $e) {
            return $this->responseError($e);
        }
    }
}
