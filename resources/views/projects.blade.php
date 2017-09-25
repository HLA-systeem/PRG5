@extends('layouts.app')

@section('content')
    @if(count($projects) > 0)
        <ul>
        @foreach($projects as $project)
            <li  class="well list-group-item"><a href="/projects/{{$project->id}}">{{$project->title}}</a></li>
        @endforeach
        </ul>
        <span id="links">{{ $projects->links() }}</span>
    @else
        <p>No projects found, maybe there is something wrong with the database connection.</p>
    @endif
@endsection