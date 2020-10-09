<?php

namespace App\Http\Controllers;

use Laravel\Lumen\Routing\Controller as BaseController;

class Controller extends BaseController
{
    /**
     * Method wrapper for JSON response.
     *
     * @param $data
     * @param string $description
     * @param int $status
     * @param array $headers
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function jsonSuccess($data, int $status, string $description = '', $headers = [])
    {
        $response = [
            'status' => empty($status) ? 200 : $status,
            'message' => empty($description) ? 'success' : $description,
            'data' => $data,
        ];

        return response()->json($response, $status, $headers);
    }
}
