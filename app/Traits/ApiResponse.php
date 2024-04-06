<?php

namespace App\Traits;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Response;

/**
 * @author Ahmed Mohamed
 */
trait ApiResponse{

    /**
     * [
     *  data =>
     *  status =>
     *  code => 200
     * ]
     * @param null $message
     * @param null $data
     * @param null $errors
     * @param int $status
     * @param null $token
     * @return Application|ResponseFactory|Response
     */
    public function apiResponse(
        $message = null,
        $data = null,
        $errors = null,
        int $status = 200,
        $token = null
    ): Response|Application|ResponseFactory
    {
        $array = [
            'message' => $message,
            'errors' => $errors,
            'data' => $data
        ];

        if($token) $array['token'] = $token;

        return response($array, $status);
    }

    /**
     * This function apiResponseValidation for Validation Request
     * @param $validator
     */
    public function apiResponseValidation($validator)
    {
        $errors = $validator->errors();
        $response = $this->apiResponse('Invalid data send', [], $errors->first(), 422);
        throw new HttpResponseException($response);
    }
}

