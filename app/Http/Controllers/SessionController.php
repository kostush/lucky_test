<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

/**
 * Class SessionController
 * @package App\Http\Controllers
 */
class SessionController extends Controller
{
    public function getSessionData(Request $request)
    {
        if($request->session()->has('name')){
            echo $request->session()->get('name');
        }
        else{
            echo ("no sesison name");
        }
    }

    /**
     * @param Request $request
     */
    public function storeSessionData(Request $request)
    {
        $request->session()->put('name',"kostush");
        echo ("data added , name = ") . $request->session()->get('name');
    }

    public function deleteSessionData(Request $request)
    {
        $request->session()->forget('name');
    }
}
