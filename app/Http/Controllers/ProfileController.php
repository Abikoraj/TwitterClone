<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use Illuminate\Auth\Events\Validated;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function upload(Request $request)
    {
        if ($request->getMethod() == "POST") {
            $request->validate([
                'profilepic' => 'required|image|mimes:jpeg,png,gif,svg|max:2048',
                'bio' => 'required'
            ]);

            $profile = new Profile;
            $profile->user_id = Auth::user()->id;
            $profile->profilepic = $request->profilepic->store('images', 'public');
            $profile->bio = $request->bio;
            $profile->save();
            return redirect()->route('home')->with('message', 'Profile Created');
        } else {
            return view('profile.add');
        }
    }

    public function edit($id)
    {
        $data = Auth::user()->profile;
        return view('profile.edit', ['profile' => $data]);
    }

    public function update(Request $request){

        $data = Auth::user()->profile;
        $data->user_id = Auth::user()->id;
        $data->profilepic = $request->profilepic->store('images', 'public');
        $data->bio = $request->bio;
        $data->save();
        return redirect()->route('home')->with('message','Profile Updated Successfully');
    }
}
