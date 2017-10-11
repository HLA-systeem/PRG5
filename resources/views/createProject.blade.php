@extends('layouts.app')

@section('content')
    {!! Form::open(['action' => 'ProjectController@store', 'method' => 'POST', 'enctype'  => 'multipart/form-data']) !!}
        <div class="form-group">
            {{ Form::label('title','Title') }}
            {{ Form::text('title', '', ['class'=>'form-control', 'placeholder'=>'Enter title']) }}
            {{ Form::label('public','Show project publicly') }}
            {{ Form::checkbox('public', true , true) }}
        </div>
        <div class="form-group">
            {{ Form::label('project_images','Project images') }}
            {{ Form::file('project_images[]', ['multiple' => 'multiple']) }}
        </div>
        <div class="form-group">
            {{ Form::label('body','Body') }}
            {{ Form::textarea('body', '', ['id' => 'ckeditor', 'class'=>'form-control', 'placeholder'=>'Enter description']) }}
        </div>
        {{Form::submit('Submit', ['class'=>'btn btn-primary'])}}
    {!! Form::close() !!}
@endsection