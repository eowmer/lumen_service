<?php

namespace App\Traits;

use Illuminate\Http\Response;

trait ApiResponser
{
     /**
      * Success Response
      *
      * @return String
      */
     public function successResponse($message, $data = [], $code = Response::HTTP_OK)
     {
          return response()->json(['message' => $message, 'data' => json_decode($data), 'code' => $code], $code)->header('Content-Type', 'application/json');
     }

     /**
      * Data Response
      *
      * @return String
      */
     public function dataResponse($message, $data = [], $code = Response::HTTP_OK)
     {
          return response()->json(['message' => $message, 'data' => $data, 'code' => $code], $code)->header('Content-Type', 'application/json');
     }

     /**
      * Error Response
      *
      * @return String
      */
     public function errorResponse($message, $code = Response::HTTP_BAD_REQUEST)
     {

          return response()->json(['error' => $message, 'code' => $code], $code);
     }

     /**
      * Error Message Response
      *
      * @return String
      */
     public function errorMessage($message, $code)
     {
          return response($message, $code)->header('Content-Type', 'application/json');
     }
}
