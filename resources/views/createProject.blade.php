@extends('layouts.app')

@section('content')
    {!! Form::open(['action' => 'ProjectController@store', 'method' => 'POST']) !!}
        <div class="form-group">
            {{ Form::label('title','Title') }}
            {{ Form::text('title', '', ['class'=>'form-control', 'placeholder'=>'Enter title']) }}
        </div>
        <div class="form-group">
            {{ Form::label('body','Body') }}
            {{ Form::text('body', '', ['id' => 'article-ckeditor', 'class'=>'form-control', 'placeholder'=>'Enter description']) }}
        </div>
        {{Form::submit('Submit', ['class'=>'btn btn-primary'])}}
    {!! Form::close() !!}
@endsection