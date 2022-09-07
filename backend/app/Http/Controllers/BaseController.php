<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BaseController extends Controller
{
    //responses existosas
    public function sendResponse($data, $http_status = 200 ){
        // 1. Construir la respuesta
        $respuesta = [
            "success" => true, 
            "data" => $data
        ];
        //2. Enviar reponse afirmativa al cliente
            return response()->json($respuesta, $http_status);
    }

    //responses de error
    public function sendError($errors, $http_status = 404){
        //1. construir respuesta de error
        $respuesta = [
            "success" => false,
            "errors" => $errors
        ];
        //2. Enviar response de error
        return response()->json($respuesta, $http_status);
    }
}
