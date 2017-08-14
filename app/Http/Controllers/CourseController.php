<?php

namespace App\Http\Controllers;

use App\Course;
use App\Lesson;
use App\UserCourse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class CourseController extends Controller
{
    public function show($slug){
        $course = Course::where('slug',$slug)->first();
        $course->lessons;
        $course->users;
        return view('course.show_course')->with('course',$course);
    }

    public function create(){
        return view('course.create_course');
    }

    public function store(Request $request){
        $this->validate($request, [
           'image' => 'required|image',
           'name' => 'required|max:100',
           'description' => 'required|max:255'
        ]);

        $request->merge(['slug' => str_slug($request->name.'-'.Auth::id()),'user_id' => Auth::id()]);
        $course = Course::create($request->all());

        if($request->hasFile('image')){
           Course::find($course->id)->update([
               'image' => $request->image->store('public/images')
           ]);
        }

        redirect('/');
    }

    public function edit($slug){
        $course = Course::where('slug',$slug)->first();
        if($course->user->id == Auth::id()){
            $lessons = $course->lessons;
            return view('course.edit_course')->with('course',$course);
        }else{
            return view('home')->with('courses',Auth::user()->courses);
        }

    }

    public function update($slug, Request $request){
        $course = Course::where('slug',$slug)->first();

        $lessons = array();
        $updateLessons = array();

        foreach ($request->lessons as $lesson){
            if(isset($lesson['id'])){
                Lesson::where('id',$lesson['id'])->update($lesson);
                $updateLessons[] = $lesson['id'];
            }else{
                $lessons[] = new Lesson($lesson);
            }
        }

        Lesson::whereNotIn('id',$updateLessons)->where('course_id',$request->id)->delete();

        if(count($lessons))
            $course->lessons()->saveMany($lessons);

        if($request->hasFile('image')) {
            File::delete('images/' . $course->image);
            Auth::user()->update([
                'avatar' => $request->image->store('public/avatars')
            ]);
        }

        $course->update(['name' => $request->name,'description' => $request->description]);

        return response()->json(['status' => 'saved','message' => 'You have successfully update this course.']);
    }

    public function destroy($id){
        $result = Course::where('id',$id)->first()->delete();
        if($result) return response()->json(['status' => 'deleted','message' => 'You have successfully delete this course!']);
        else return response()->json(['status' => 'failed','message' => 'You have failed delete this course!']);
    }

    public function joinCourse($id){
        $result = UserCourse::create([
            'user_id' => Auth::id(),
            'course_id' => $id
        ]);

        if($result) return response()->json(['status' => 'joined','message' => 'You have successfully joined this course!']);
        else return response()->json(['status' => 'failed','message' => 'You have failed joined this course!']);
    }


}
