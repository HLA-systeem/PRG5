@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Dashboard</div>

                    <div class="panel-body">
                        <table class="table table-striped">
                            <tr>
                                <th></th>
                                <th></th>
                                <th></th>
                            </tr>
                            @if(count($projects)>0)
                                @foreach($projects as $project)
                                <tr>
                                    <td><a href="/projects/{{$project->id}}">{{$project->title}}</a></td>
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
                                <h4>You will see your projects here, as soon as you upload them</h4>    
                            @endif
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
