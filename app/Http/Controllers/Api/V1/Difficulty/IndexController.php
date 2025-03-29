<?php

namespace App\Http\Controllers\Api\V1\Difficulty;

use App\Http\Controllers\Controller;
use App\Http\Resources\DifficultyCollection;
use App\Repositories\DifficultyRepository;
use App\Traits\Response;
use Illuminate\Http\JsonResponse;

class IndexController extends Controller
{
    use Response;

    public DifficultyRepository $difficulty;

    public function __construct(DifficultyRepository $difficulty) {
        $this->difficulty = $difficulty;
    }

    public function __invoke(): JsonResponse
    {
        try {
            return new DifficultyCollection($this->difficulty->all())
                ->response();
        } catch (\Exception $e) {
            return $this->responseError($e);
        }
    }
}
