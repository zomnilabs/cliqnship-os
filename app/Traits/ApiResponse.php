<?php
namespace App\Traits;

trait ApiResponse {
    public function responseOk($data)
    {
        $response = $data;

        return response()->json($response, 200);
    }

    public function responseCreated($data)
    {
        $response = [
            'data'      => $data,
            'status'    => 201
        ];

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
}