@extends('layouts.app')

@section('content')
    <h3>Name: {{$project->title}}</h3>
    <span>Created at:{{$project->created_at}}</span>
    <span>Times Viewed:{{$project->times_viewed}}</span>
    <hr>
    <p>{!!$project->body!!}</p>
    <hr>
    <a href="projects/{{$project->id/edit}}" class="btn btn-default">edit</a>

    {{!!Form::open(['action' => ['ProjectController@destroy', $project->id], 'method' => 'POST', 'class'=> 'pull-right'])!!}}
        {{Form::hidden('_method', 'DELETE')}}
        {{Form::submit('Delete', ['class' => 'btn btn-danger'])}}
    {{!!Form::close()!!}}
@endsection