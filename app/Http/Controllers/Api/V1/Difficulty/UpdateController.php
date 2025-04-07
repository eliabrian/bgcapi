<?php

namespace App\Http\Controllers\Api\V1\Difficulty;

use App\Http\Controllers\Controller;
use App\Http\Requests\Difficulty\UpdateDifficultyRequest;
use App\Http\Resources\DifficultyResource;
use App\Repositories\DifficultyRepository;
use App\Traits\Response;
use Illuminate\Support\Facades\DB;

class UpdateController extends Controller
{
    use Response;

    public DifficultyRepository $difficulty;

    public function __construct(DifficultyRepository $difficulty)
    {
        $this->difficulty = $difficulty;
    }

    public function __invoke(string $id, UpdateDifficultyRequest $request)
    {
        try {
            $validated = $request->safe()->only(['name', 'slug']);

            $difficulty = $this->difficulty->get($id);

            DB::transaction(fn () => $difficulty->update(
                [
                    ...$validated,
                ]
            ));

            return new DifficultyResource($difficulty);
        } catch (\Exception $e) {
            return $this->responseError($e);
        }
    }
}
