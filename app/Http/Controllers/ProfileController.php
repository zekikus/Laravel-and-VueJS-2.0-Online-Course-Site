<?php

namespace App\Http\Controllers;

use App\Profile;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function show($id){
        $profile = Profile::where('user_id',$id)->first(['user_id','location','about','avatar']);
        $profile->courses;
        return view('profile.show_profile')->with('profile',$profile);
    }

    public function update($id,Request $request){
        $this->validate($request,[
           'location' => 'required|max:255',
           'about' => 'required|max:1500'
        ]);

        $result = Profile::where('user_id',$id)->first()->update([
            'location' => $request->location,
            'about' => $request->about
        ]);

        if($result)
            return response()->json(['status' => 'updated','message' => 'You have succesfully updated profile!']);
        return response()->json(['status' => 'failed','message' => 'You have failed updated profile!']);
    }
}
