@extends('layouts.app')

@section('content')
    {!! Form::open([action => ['ProjectController@update', $project->id], 'method' => 'POST']) !!}
        <div class="form-group">
            {{ Form::label('title','Title') }}
            {{ Form::text('title', $project->title, ['class'=>'form-control', 'placeholder'=>'Enter title']) }}
        </div>
        <div class="form-group">
            {{ Form::label('body','Body') }}
            {{ Form::text('body', $project->body, ['id' => 'article-ckeditor', 'class'=>'form-control', 'placeholder'=>'Enter description']) }}
        </div>
        {{Form::hidden('_method', 'PUT')}} <!--spoof PUT request -->
        {{Form::submit('Submit', ['class'=>'btn btn-primary'])}}
    {!! Form::close() !!}
@endsection