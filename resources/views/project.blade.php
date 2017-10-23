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
    <div>
        <h3 class="col-xs-12">{{$project->title}}</h3>
        <span class="col-xs-2">Created at:{{$project->created_at}}</span>
        <span class="col-xs-offset-1 col-xs-1">Times Viewed:{{$project->times_viewed}}</span>
        <div class="col-xs-12">
        <hr>
        @foreach($project->images as $image)
            <img src="{{route('project image', $image->url)}}"/>
        @endforeach
        <p>{!!$project->body!!}</p>
        <hr>

        @if(!Auth::guest())
            @if(Auth::user()->id == $project->creator_id || Auth::user()->role == "admin" )
                <a href="{{$project->id}}/edit" class="btn btn-default">edit</a>

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