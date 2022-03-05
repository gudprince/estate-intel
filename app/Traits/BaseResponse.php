<?php

namespace App\Traits;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

trait BaseResponse
{
    /**
     * success response method.
     *
     * @return \Illuminate\Http\Response
     */
    public function sendResponse($result, $message, $code = 200)
    {
    	$response = [
            'status_code'=> $code,
            'status' => 'success',
            'message' => $message,
            'data' => $result,
            
        ];

        return response()->json($response, 200);
    }

    /**
     * return error response.
     *
     * @return \Illuminate\Http\Response
     */
    public function sendError($error, $errorMessages = [])
    {
    	$response = [
            'success' => false,
            'message' => $error,
        ];


        if(!empty($errorMessages)){
            $response['data'] = $errorMessages;
        }

        return response()->json($response);
    }
}
