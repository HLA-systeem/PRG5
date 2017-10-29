@extends('layouts.app')

@section('content')
    @if(!Auth::guest())
        @if(Auth::user()->id == $project->creator_id)
        <div class="col-md-offset-10 col-md-2">
            <span id="publicToggle">
                Show this project publicly:
                {!! ToggleSwitchButton::render('public', $project->public) !!}
            </span>
        </div>
        @endif
    @endif
    <div class="row">
        <h3 class="col-xs-12">{{$project->title}}</h3>
    </div>
    <div class="row">
        <span class="col-xs-2">Created at:{{$project->created_at}}</span>
        <span class="col-xs-offset-1 col-xs-2">Times Viewed: {{$project->times_viewed}}</span>
    </div>

    <div class="row">
        <hr>
        @if($project->images[0]->url != null)
        <div class="col-xs-6">
            @foreach($project->images as $image)
            <img class="img.responsive col-xs-12" src="{{route('project image', $image->url)}}"/>
            @endforeach
        </div>
        @endif
        <div class="col-xs-6">
            <p>{!!$project->body!!}</p>
        </div>
    </div>
    <hr>
    <div class="row">
        <div id="allTags" class="col-xs-offset-5"><!--change to flexbox in future-->
            @foreach($project->tags as $tag)
            <span class="btn btn-default">{{$tag->name}}</span>
            @endforeach
        </div>
    </div>
    <div class="row">
        @if(!Auth::guest())
            @if(Auth::user()->id == $project->creator_id || Auth::user()->role == "admin" )
            <a href="{{$project->id}}/edit" class="btn btn-warning">edit</a>
            {!! Form::open(['action' => ['ProjectController@destroy', $project->id], 'method' => 'POST', 'class'=> 'pull-right']) !!}
                {{ Form::hidden('_method', 'DELETE') }}
                {{ Form::submit('Delete', ['class' => 'btn btn-danger']) }}
            {!! Form::close() !!}
            @endif
        @endif
    </div>

    <script>
        var id = '{{ $project->id }}';
        var sendTo = '/updateAs/public';
        var token = '{{ csrf_token() }}';    
    </script>
@endsection