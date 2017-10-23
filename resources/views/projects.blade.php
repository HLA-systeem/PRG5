@extends('layouts.app')

@section('content')
    <div id="filterSection" class="col-md-2">
        {{ Form::label('search','Search Projects') }}
        {{ Form::text('search', ' ',['id'=>'searchBar']) }}
    </div>
    @if(count($projects) > 0)
        <ul class=" col-md-8">
        @foreach($projects as $project)
            <a href="/projects/{{$project->id}}">
                <li class="well list-group-item">
                    <div class="row">
                        <div class="col-md-8">
                        <!--<img src="/storage/project_images/{$image->url}">-->
                        </div>
                        <div class="col-md-4">
                            <span>{{$project->title}}</span>
                        </div>
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