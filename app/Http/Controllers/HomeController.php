<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    //
    public function index(){
        $data=Post::latest()->paginate(10);
        return view('Home.index',['list'=>$data]);
    }

    public function profile($id){
        $data = User::find($id);
        $post = Post::where('user_id',$id)->get();
        // dd($post);
        return view('profile.profile',['user'=>$data, 'post'=>$post]);
        // dd($data->name, $data->profile->bio, $data->profile->profilepic);
    }
}
