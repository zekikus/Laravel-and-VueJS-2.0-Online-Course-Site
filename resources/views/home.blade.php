@extends('layouts.app')

@section('content')
<div class="container">

    @if(count($courses))
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
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

    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Buy Course</div>
            </div>
        </div>

        @foreach(Auth::user()->buyingCourses as $course)
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
</div>
@endsection
