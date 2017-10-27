@extends('layouts.app')

@section('content')

    <div id="filterSection" class="col-xs-2">
        {{ Form::label('search','Search Projects') }}
        {{ Form::text('search', ' ',['id'=>'searchBar']) }}
    </div>    
    
    @if(count($projects) > 0)
        <ul class="col-xs-8" id="projectList">
        @foreach($projects as $project)
            <a href="/projects/{{$project->id}}">
                <li class="well list-group-item col-xs-12">
                    <div class="col-xs-2">
                        @foreach($thumbnails as $thumbnail)
                        @if($thumbnail && ($thumbnail['project_id'] == $project->id))
                        <img class="projectsImages" src="{{route('project image', $thumbnail['url'])}}"/>
                        @endif 
                        @endforeach
                    </div>
                    <div class="col-xs-10">
                        <span>{{$project->title}}</span>
                    </div>
                </li>
            </a>
        @endforeach
        </ul>
        <span id="links">{{ $projects->links() }}</span>
    @else
        <p>No projects found, maybe there is something wrong with the database connection.</p>
    @endif

    <script>
        var sendTo = '/updateAs/search';
        var token = '{{ csrf_token() }}';    
    </script>
@endsection