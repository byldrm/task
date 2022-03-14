<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\API\BaseController as BaseController;
use App\Http\Resources\UserListResource;
use App\Models\UserList;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Validator;

class UserListController extends BaseController
{

    private $apis = [
        'jsonplaceholder' =>'https://jsonplaceholder.typicode.com/users',
        'reqres' =>'https://reqres.in/api/users'
    ];
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        if (Cache::has('userList')) {
            $data = Cache::get('userList');
        }else{
            $data = UserList::all();
            Cache::put('userList', $data, 600);
        }

        return $this->sendResponse(UserListResource::collection($data), 'Successful');

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();
        $validator = Validator::make($data, [
            'name' => 'required|max:50'
        ]);

        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());
        }

        $user = UserList::updateOrCreate(
            ['api_name'=>$data['api_name'],'api_id'=>$data['api_id']],
            ['name'=>$data['name']]
        );

        Cache::put('userList', UserList::all(), 600);
        return $this->sendResponse(new UserListResource($user), 'Successful');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function api_list()
    {
        return $this->sendResponse($this->apis, 'Successful');

    }

    public function get_users_from_api(Request $request)
    {
        $users  =  json_decode(Http::get($this->apis[$request->api]));
        if($request->api =='reqres'){
            $users_data = $users->data;
            // Sayfa sayısı 1 den fazla ise datayı tek dizide birleştirdim.
            for($page = 2; $page <= $users->total_pages; $page++){
                $last_page = json_decode(Http::get($this->apis[$request->api].'?page='.$page))->data;
                $users_data = array_merge($users_data, $last_page);
            }
            //https://reqres.in/api/users buradan gelen datanın formatını düzenledim
            $users = array_map(function($user_data) {
                return (object) array(
                    'name' => $user_data->first_name.' '.$user_data->last_name,
                    'id'=>$user_data->id
                );
            }, $users_data);
        }

        return $this->sendResponse($users, 'Successful');

    }
}
