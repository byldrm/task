<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class UserListController extends Controller
{

    private $api_url = 'http://app-shared-nginx/api/';

    private function get_url($endpoint){
        return $this->api_url.$endpoint;
    }

    public function index()
    {
        $apis = Http::get($this->get_url('api_list'));
        return view('index',['apis'=>json_decode($apis)->apis]);
    }

    public function get_users_from_api(Request $request)
    {

        $response = Http::post( $this->get_url('get_users_from_api'), [
            'api' => $request->api,
        ]);
        $view = view('get_user_list_from_api')->with(['users'=> json_decode($response->getBody())->users])->render();
        return response()->json($view);
    }

    public function user_save(Request $request)
    {
        $response = Http::post( $this->get_url('user_list'), [
            'name' => $request->name,
        ]);
        return redirect()->back()->with('success', json_decode($response->getBody())->message);
    }

    public function user_list()
    {
        $data = Http::get($this->get_url('user_list'));
        return view('user_list',['users'=>json_decode($data)->users]);
    }
}
