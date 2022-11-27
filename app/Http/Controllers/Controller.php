<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    //common API response
    public function apiResponse($success= true,$response=[],$status_code = API_RES_STATUS_SUCCESS, $msg ='')
    {
        if ($success){
            return response(['success'=> true, 'msg'=>$msg,'data'=>$response],$status_code)->header('Content-Type', 'application/json');
        }else{
            return response(['success'=> false, 'error'=>$response],$status_code)->header('Content-Type', 'application/json');
        }
    }
}
