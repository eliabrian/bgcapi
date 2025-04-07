<?php

namespace App\Http\Controllers\Api\V1\Tag;

use App\Http\Controllers\Controller;
use App\Repositories\TagRepository;
use App\Traits\Response;
use Illuminate\Support\Facades\DB;

class DestroyController extends Controller
{
    use Response;

    public TagRepository $tag;

    public function __construct(TagRepository $tag)
    {
        $this->tag = $tag;
    }

    public function __invoke(string $id)
    {
        try {
            $tag = $this->tag->get($id);

            DB::transaction(fn () => $tag->delete());

            return $this->responseSuccess(
                [
                    'result' => 'ok',
                    'message' => 'Tag deleted!',
                ]
            );
        } catch (\Exception $e) {
            return $this->responseError($e);
        }
    }
}
