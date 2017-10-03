@extends('layouts.app')

@section('content')
    @if(count($projects) > 0)
        <ul>
        @foreach($projects as $project)
            <li class="well list-group-item">> 
                <div class="row">
                    <div class="col-md-2 col-md-offset-6">
                        <!--<img src="/storage/project_images/{$image->url}">-->
                    </div>
                    <div class="col-md-4">
                    <a href="/projects/{{$project->id}}">{{$project->title}}</a>
                    </div>
                </div>
            </li>
        @endforeach
        </ul>
        <span id="links">{{ $projects->links() }}</span>
    @else
        <p>No projects found, maybe there is something wrong with the database connection.</p>
    @endif
@endsection