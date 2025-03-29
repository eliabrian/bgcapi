<?php

namespace App\Traits;

use Illuminate\Http\JsonResponse;

trait Response
{
    /**
     * Generate a successful response.
     *
     * @param $data
     * @param int $code
     *
     * @return JsonResponse
     */
    protected function responseSuccess($data, int $code = JsonResponse::HTTP_OK): JsonResponse
    {
        return response()->json(
            data: $data,
            status: $code
        );
    }

    /**
     * Generate an error response.
     *
     * @param \Exception $errors
     * @param int $code
     *
     * @return JsonResponse
     */
    protected function responseError(\Exception $errors, int $code = JsonResponse::HTTP_BAD_REQUEST): JsonResponse
    {
        return response()->json(
            data: [
                'result' => 'error',
                'errors' => [
                    'status' => $code,
                    'message' => $errors->getMessage(),
                ],
            ],
            status: $code,
        );
    }
}
