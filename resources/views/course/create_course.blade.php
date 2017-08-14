@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Create Course</div>

                    <div class="panel-body">
                        <form  action="{{route('courses.store')}}" method="POST" enctype="multipart/form-data">
                            {{csrf_field()}}
                            <div class="form-group">
                                <label>Upload Image</label>
                                <input type="file" name="image" class="form-control" accept="image/*"/>
                            </div>
                            <div class="form-group">
                                <label>Name</label>
                                <input type="text" name="name" value="" class="form-control" />
                            </div>
                            <div class="form-group">
                                <label>Description</label>
                                <textarea name="description" class="form-control"></textarea>
                            </div>
                            <div class="form-group">
                                <button class="btn btn-success">Create Course</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection