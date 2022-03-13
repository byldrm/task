@extends('master')

@section('content')
    <div class="container">
        <div class="api_lists" data-url="{{route('get_users_from_api')}}">
            <div class="row">
                <div class="col">
                    <h3>Veritabanında kayıtlı kullanıcılar</h3>
                </div>
                <div class="col">
                    <a class="pull-right" href="{{route('index')}}">İndex</a>
                </div>
            </div>



            <div class="row">
                <ul>
                    @foreach($users as $user)
                    <li>{{$user->name}}</li>
                    @endforeach
                </ul>
            </div>
        </div>
        <hr>

        <div class="user_list">

        </div>
    </div>

@endsection
