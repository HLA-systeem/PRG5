@extends('layouts.app')

@section('content')
    {!! Form::open(['action' => ['UserController@update', $user->id], 'method' => 'POST']) !!}
        <div class="row">
            <div class="form-group col-xs-offset-4 col-xs-2">
                {{ Form::label('name','User Name') }}
                {{ Form::text('name', $user->name, ['class'=>'form-control', 'placeholder'=>'Name']) }}
            </div>
        </div>
        <div class="row">
            <div class="form-group col-xs-offset-4 col-xs-2">
                {{ Form::label('email','E-mail') }}
                {{ Form::text('email', $user->email, ['class'=>'form-control', 'placeholder'=>'Email']) }}
            </div>
        </div>
        <div class="row">
            <div class="form-group col-xs-offset-4 col-xs-2">
                {{ Form::label('pass','Password') }}
                {{ Form::password('pass', ['class'=>'form-control', 'placeholder'=>'Password']) }}
            </div>
        </div>
        <div class="row col-xs-offset-4 col-xs-2">
        {{Form::hidden('_method', 'PUT')}} <!--spoof PUT request -->
        {{Form::submit('Change', ['class'=>'btn btn-default pull-right' ])}}
        </div>
    {!! Form::close() !!}
@endsection