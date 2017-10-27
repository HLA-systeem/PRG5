@extends('layouts.app')

@section('content')
@foreach($projects as $project)
<a href="/projects/{{$project->id}}" class="entranceProjects"> 
    @foreach($thumbnails as $thumbnail)
    @if($thumbnail && ($thumbnail['project_id'] == $project->id))
        <img class="entranceImages" src="{{route('project image', $thumbnail['url'])}}"/>
    @endif 
    @endforeach
</a>
@endforeach
@endsection
