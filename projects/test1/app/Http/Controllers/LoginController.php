<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;


class LoginController extends Controller
{
    public function login()
    {
        return view('login');
    }

    public function login_post(Request $request)
    {
         $data = $request->all();
        $validator = Validator::make($data, [
            'email' => 'required|max:255|email',
            'password' =>'required'
        ]);
        if($validator->fails()){
            return redirect()->back()->withErrors($validator);
        }

        $user = Http::post('http://app-shared-nginx/api/login',[
            'email' =>$request->email,
            'password'=>$request->password
        ]);
        $user = json_decode($user);
        if($user->status){
            Session(['UsersData'=> $user->data]);
            return  redirect()->route('dashboard');
        }else{
            return redirect()->back()->with('failed', 'Eposta veya şifre hatalı!');
        }
    }

    public function logout(Request $request)
    {
        $request->session()->forget('UsersData');
        return redirect()->route('login');
    }
}
