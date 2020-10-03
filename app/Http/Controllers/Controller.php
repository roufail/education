<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;


    public function response($response, $message = '')
    {
    	$response = [
            'success'  => true,
            'response' => $response,
            'message'  => $message,
        ];
        return response()->json($response, 200);
    }


    /**

     * return error response.

     *

     * @return \Illuminate\Http\Response

     */

    public function error($error, $data = null ,$code = 500)

    {
    	$response = [
            'success' => false,
            'message' => $error,
        ];

        if($data) {
            $response['data'] = $data;
        }
        return response()->json($response, $code);
    }


}
