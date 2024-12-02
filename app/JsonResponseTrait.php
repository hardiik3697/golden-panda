<?php

namespace App;

trait JsonResponseTrait
{
    /**
     * Return a JSON response with a dynamic status and message.
     *
     * @param mixed $data
     * @param string $message
     * @param int $status
     * @param int $code
     * @return \Illuminate\Http\JsonResponse
     */
    public function jsonResponse($data = null, $message = '', $status = true, $code = 200)
    {
        return response()->json([
            'status' => $status,
            'message' => $message,
            'data' => $data,
        ], $code);
    }

    /**
     * Return a success response.
     *
     * @param mixed $data
     * @param string $message
     * @return \Illuminate\Http\JsonResponse
     */
    public function successResponse($data = null, $message = 'Request successful.')
    {
        return response()->json([
            'message' => $message,
            'data' => $data,
        ], 200);
    }

    /**
     * Return an error response.
     *
     * @param string $message
     * @param int $code
     * @param mixed $data
     * @return \Illuminate\Http\JsonResponse
     */
    public function errorResponse($message = 'An error occurred.', $code = 400, $data = null)
    {
        return response()->json($data, $message, false, $code);
    }
}
