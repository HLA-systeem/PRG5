@extends('layouts.app')

@section('content')
        <img src="../avatars/default_white.png"><!--{ Auth::user()->avatar }}--></img>
        <h4>Username: {{ Auth::user()->name }}</h4>
        <h4>E-mail: {{ Auth::user()->email }}</h4>
        <a href="user/edit" class="btn btn-default">edit</a>
@endsection