<ul>
    @foreach($users as $user)
    <li>
        <form action="{{route('user_save')}}" method="post">
            @csrf
            <input type="text" name="name" readonly value="{{$user->name}}">
            <button type="submit">Kaydet</button>
        </form>
    </li>
    @endforeach
</ul>
