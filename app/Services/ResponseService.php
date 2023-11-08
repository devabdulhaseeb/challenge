<?php 
namespace App\Services;

use Illuminate\Support\Facades\Response;

class ResponseService
{
    public function sendResponse($data, $message, $code)
    {
        return Response::make([
            "success" => true,
            "message" => $message,
            "data" => $data,
        ], $code);
    }

    public function sendError($message, $code)
    {
        return Response::make([
            "success" => false,
            "message" => $message,
        ], $code);
    }
}
