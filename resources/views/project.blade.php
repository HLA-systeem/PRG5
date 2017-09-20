@extends('layouts.app')

@section('content')
    <h3>Name: {{$project->title}}</h3>
    <span>Times Viewed:{{$project->times_viewed}}</span>+
    <hr>
    <p>{{$project->body}}</p>
@endsection