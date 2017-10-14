@extends('layouts.app')

@section('content')
    {!! Form::open(['action' => 'ProjectController@store', 'method' => 'POST', 'enctype'  => 'multipart/form-data']) !!}
        <div class="col-md-offset-10 col-md-2">
            <span id="publicToggle">
                Show this project publicly:
                {!! ToggleSwitchButton::render('public', true) !!}
            </span>
        </div>
        <div>
            <div class="form-group">
                {{ Form::label('title','Title') }}
                {{ Form::text('title', '', ['class'=>'form-control', 'placeholder'=>'Enter title']) }}
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
        </div>
    {!! Form::close() !!}
@endsection