<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function index(Request $request)
    {
        return view('home.login');
    }

    public function submit(Request $request)
    {
        return $request->all();
    }
}
