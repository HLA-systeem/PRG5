@extends('layouts.app')

@section('content')
    {!! Form::open(['action' => ['userController@update'], 'method' => 'POST']) !!}
        <div class="form-group">
            {{ Form::label('name','User Name') }}
            {{ Form::text('name', Auth::user()->name, ['class'=>'form-control', 'placeholder'=>'Enter title']) }}
        </div>
        <div class="form-group">
            {{ Form::label('email','E-mail') }}
            {{ Form::textarea('email', Auth::user()->email, ['id' => 'ckeditor', 'class'=>'form-control', 'placeholder'=>'Enter description']) }}
        </div>
        <div class="form-group">
            {{ Form::label('pass','Password') }}
            {{ Form::password('pass', Auth::user()->password, ['id' => 'ckeditor', 'class'=>'form-control', 'placeholder'=>'Enter description']) }}
        </div>
        {{Form::hidden('_method', 'PUT')}} <!--spoof PUT request -->
        {{Form::submit('Submit', ['class'=>'btn btn-primary'])}}
    {!! Form::close() !!}
@endsection