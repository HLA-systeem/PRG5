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
        <h3>Name: {{$project->title}}</h3>
        <span>Created at:{{$project->created_at}}</span>
        <span>Times Viewed:{{$project->times_viewed}}</span>
        <hr>
        @foreach($project->images as $image)
            <img src="/storage/app/public/project_images/{{$image->url}}">
        @endforeach
        <p>{!!$project->body!!}</p>
        <hr>

        @if(!Auth::guest())
            @if(Auth::user()->id == $project->creator_id)
                <a href="{{$project->id}}/edit" class="btn btn-default">edit</a>

                {!! Form::open(['action' => ['ProjectController@destroy', $project->id], 'method' => 'POST', 'class'=> 'pull-right']) !!}
                    {{ Form::hidden('_method', 'DELETE') }}
                    {{ Form::submit('Delete', ['class' => 'btn btn-danger']) }}
                {!! Form::close() !!}
            @endif
        @endif
    </div>
@endsection