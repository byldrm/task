@extends('master')

@section('content')
<div class="container">
    <div class="api_lists" data-url="{{route('get_users_from_api')}}">
        <div class="row">
            <div class="col">
                <h3>Kullanmak İstediğiniz Apiyi Seçiniz</h3>
            </div>
            <div class="col">
                <a class="pull-right" href="{{route('user_list')}}">Kayıtlı Kullanıcılar</a>
            </div>
        </div>



        <div>
            @if (session('success'))
                <div class="alert alert-success"><strong>Başarılı!</strong>{{session('success')}}</div>
            @endif
            @if (session('failed'))
                <div class="alert alert-danger"><strong>Hata!</strong> {{session('failed')}}</div>
            @endif
        </div>
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
            <label >
                <input class="api"  type="radio" name="api" id="listGroupRadios1" value="" checked>
                <span>Seçiniz</span>
            </label>
            @foreach($apis as $key => $api)
            <label>
                <input class="api" type="radio" name="api" id="listGroupRadios{{$key}}" value="{{$key}}" >
                <span>{{$key}}</span>
            </label>
            @endforeach

    </div>
    <hr>

    <div class="user_list">

    </div>
</div>

@endsection
