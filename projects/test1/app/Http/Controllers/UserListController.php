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

    public function get_data($endpoint,$data=[],$method ='get')
    {
        $access_token =  Session('UsersData')->token;
        $result = Http::withHeaders([
            'Accept' => 'application/json',
            'Authorization' => 'Bearer '.$access_token,
        ])->$method($this->get_url($endpoint),$data);

        return json_decode($result);
    }

    public function index()
    {
        $apis = $this->get_data('api_list');
        return view('dashboard',['apis'=>$apis]);
    }

    public function get_users_from_api(Request $request)
    {
        $data =  ['api' => $request->api];
        $response = $this->get_data('get_users_from_api',$data,'post');
        $view = view('get_user_list_from_api')->with(['users'=>$response->data,'api_name'=>$request->api])->render();
        return response()->json($view);
    }

    public function user_save(Request $request)
    {
        $data = ['name' => $request->name,'api_name'=>$request->api_name,'api_id'=>$request->api_id];
        $response = $this->get_data('user_list',$data,'post');
        return redirect()->back()->with('success',$response->message);
    }

    public function user_list()
    {
        $data = $this->get_data('user_list');
        return view('user_list',['users'=>$data->data]);
    }
}
