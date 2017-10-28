@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-xs-8 col-xs-offset-2">
            <h4 class="panel-heading">Admin Dashboard</h4>

            <div class="panel-users col-xs-6">
                <h5 class="panel-heading">Users</h5>
                <table class="table table-striped">
                    <tr>
                        <th></th>
                        <th></th>
                        <th></th>
                    </tr>
                    @if(count($users)>0)
                    @foreach($users as $user)
                    <tr>
                        <td><a href="/user/{{$user->id}}/edit">{{$user->name}}</a></td>
                        <td>{{$user->email}}</td>
                        <td>   
                            {!! Form::open(['action' => ['UserController@destroy', $user->id], 'method' => 'POST', 'class'=> 'pull-right']) !!}
                            {{ Form::hidden('_method', 'DELETE') }}
                            {{ Form::submit('Delete', ['class' => 'btn btn-danger']) }}
                            {!! Form::close() !!}           
                        </td>
                    </tr>
                    @endforeach
                    @else
                    <h4>No Users?</h4>    
                     @endif
                </table>
            </div>

            <div class="panel-projects col-xs-6">
                <h5 class="panel-heading">Projects</h5>
                <table class="table table-striped">
                    <tr>
                        <th></th>
                        <th></th>
                        <th></th>
                    </tr>
                    @if(count($projects)>0)
                    @foreach($projects as $project)
                    <tr>
                        <td><a href="/projects/{{$project->id}}/edit">{{$project->title}}</a></td>
                        <td>{{$project->times_viewed}}</td>
                        <td>   
                            {!! Form::open(['action' => ['ProjectController@destroy', $project->id], 'method' => 'POST', 'class'=> 'pull-right']) !!}
                            {{ Form::hidden('_method', 'DELETE') }}
                            {{ Form::submit('Delete', ['class' => 'btn btn-danger']) }}
                            {!! Form::close() !!}           
                        </td>
                    </tr>
                    @endforeach
                    @else
                    <h4>No Projects...</h4>    
                    @endif
                </table>
            </div>
        </div>
    </div>
</div>
@endsection