<?php

namespace App\Http\Controllers\Api\V1\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\AuthUserRequest;
use App\Traits\Response;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    use Response;

    public function __invoke(AuthUserRequest $request): JsonResponse
    {
        try {
            if (Auth::attempt(
                $request->safe()->only(['email', 'password'])
            )) {

                $user = Auth::user();
                $user->tokens()->delete();

                $token = $user->createToken($user->name . "_token")
                    ->plainTextToken;

                return $this->responseSuccess(
                    ['token' => $token],
                );
            } else {
                abort(401, 'Invalid credentials.');
            }
        } catch (\Exception $e) {
            return $this->responseError($e, JsonResponse::HTTP_UNAUTHORIZED);
        }
    }
}
