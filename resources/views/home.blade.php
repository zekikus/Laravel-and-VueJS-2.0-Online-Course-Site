@extends('layouts.app')

@section('content')
<div class="container">
    <search></search>
    @if(count($courses))
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-success">
                <div class="panel-heading">My Courses</div>

            </div>
        </div>

        @foreach($courses as $course)
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading"><a href="/courses/{{$course->slug}}">{{$course->name}}</a></div>

                <div class="panel-body">
                    <p>{{$course->description}}</p>
                </div>
            </div>
        </div>
        @endforeach

    </div>
    @endif
    <hr/>
    @if(count(Auth::user()->buyingCourses))
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-primary">
                <div class="panel-heading">Buy Course</div>
            </div>
        </div>

        @foreach(Auth::user()->buyingCourses as $course)
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading"><a href="/courses/{{$course->slug}}">{{$course->name}}</a></div>

                    <div class="panel-body">
                        <p>{{$course->description}}</p>
                        <span class="pull-right"><b>Educator: {{$course->user->name}}</b></span>
                    </div>
                </div>
            </div>
        @endforeach
     @endif
    </div>
</div>
@endsection
