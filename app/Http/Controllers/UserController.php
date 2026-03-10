<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function login()
    {
        return view('backend.pages.login');
    }

    public function doLogin(Request $request)
    {
        // dd($request->all());
        $userInput=$request->except('_token');
        // dd($userInput);

        $checkLogin=auth()->attempt($userInput);
        // $checkLogin=Auth::attempt($userInput);
        // dd($checkLogin);

        if($checkLogin)
        {
            notify()->success('Login Successful');
            return redirect()->route('admin.home.page');
        }

        notify()->error('Invalid Credentials');
        return redirect()->back();
    }
    public function logout()
    {
        auth()->logout();
        // Auth::logout();
        return redirect()->route('admin.login');
    }
}
