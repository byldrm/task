@extends('master')

@section('content')


<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Seçilen Apiden Kullanıcı Listesini Çekme</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item active">Seçilen Apiden Kullanıcı Listesini Çekme</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content api_lists" data-url="{{route('get_users_from_api')}}">
        <div class="container-fluid">
            <div class="row">
                <div>
                    @if (session('success'))
                        <div class="alert alert-success"><strong>Başarılı!</strong>{{session('success')}}</div>
                    @endif
                    @if (session('failed'))
                        <div class="alert alert-danger"><strong>Hata!</strong> {{session('failed')}}</div>
                    @endif
                </div>

                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Kullanmak İstediğiniz Apiyi Seçiniz</h3>
                            <div class="api_list">
                                <label class="pl-1">
                                    <input class="api"  type="radio" name="api" id="listGroupRadios1" value="" checked>
                                    <span>Seçiniz</span>
                                </label>
                                @foreach($apis->data as $key => $api)
                                    <label class="pl-1">
                                        <input class="api" type="radio" name="api" id="listGroupRadios{{$key}}" value="{{$key}}" >
                                        <span>{{$key}}</span>
                                    </label>
                                @endforeach
                            </div>

                        </div>
                        <!-- /.card-header -->
                      <div class="user_list"></div>

                    </div>
                    <!-- /.card -->

                </div>

            </div>

        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
@endsection
