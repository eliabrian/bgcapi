<?php

namespace App\Http\Controllers\Api\V1\Auth;

use App\Http\Controllers\Controller;
use App\Traits\Response;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class LogoutController extends Controller
{
    use Response;

    public function __invoke(): JsonResponse
    {
        try {
            $user = Auth::user();

            $user->tokens()->delete();

            return $this->responseSuccess(
                ['message' => 'Logged out!'],
            );
        } catch (\Exception $e) {
            return $this->responseError($e, JsonResponse::HTTP_UNAUTHORIZED);
        }
    }
}
