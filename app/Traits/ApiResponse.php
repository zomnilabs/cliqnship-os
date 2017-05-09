<?php
namespace App\Traits;

trait ApiResponse {
    public function responseOk($data)
    {
        $response = $data;
        $response['status'] = 200;

        return response()->json($response, 200);
    }

    public function responseCreated($data)
    {
        $response = $data;
        $response['status'] = 201;

        return response()->json($response, 201);
    }

    public function responseNotFound()
    {
        $response = [
            'errors'    => ['nothing found'],
            'status'    => 404
        ];

        return response()->json($response, 404);
    }

    public function responseBadRequest($errors)
    {
        $response = [
            'errors'    => $errors,
            'status'    => 400
        ];

        return response()->json($response, 400);
    }

    public function responseUnauthorized()
    {
        $response = [
            'errors'    => ['unauthorized'],
            'status'    => 401
        ];

        return response()->json($response, 401);
    }
}