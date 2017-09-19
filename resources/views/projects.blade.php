@extends('layouts.app')

@section('content')
    @if(count($projects) > 0)
        <ul>
        @foreach($projects as $project)
            <li class="well"><a href="/projects/{{$project->id}}">{{$project->title}}</a></li>
        @endforeach
        </ul>
        <!--$projects->links}} werkt nog niet-->
    @else
        <p>No projects found, maybe there is something wrong with the database connection.</p>
    @endif
@endsection