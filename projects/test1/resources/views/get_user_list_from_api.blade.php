
<div class="card-body">
    <table class="table table-bordered" data-url="{{route('user_save')}}">
        <thead>
        <tr>
            <th style="width: 10px">#</th>
            <th>İsim Soyisim</th>
            <th style="width: 40px">Eylem</th>
        </tr>
        </thead>
        <tbody>
        @foreach($users as $user)
        <tr>
            <td>1.</td>
            <td>  {{$user->name}}</td>

            <td>
                <form action="{{route('user_save')}}" method="post">
                    @csrf
                    <input type="hidden" name="name"  value="{{$user->name}}">
                    <input type="hidden" name="api_name" value="{{$api_name}}">
                    <input type="hidden" name="api_id" value="{{$user->id}}">
                    <button class="btn btn-success" >Kaydet</button>
                </form>
            </td>

        </tr>
        @endforeach
        </tbody>
    </table>
</div>
