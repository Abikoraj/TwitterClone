<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Profile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class PostController extends Controller
{
    public function add(Request $request){
        $request->validate([
            'desc'=>'required'
        ]);
        $post=new Post();
        $post->desc = $request->desc;
        $post->user_id=Auth::user()->id;
        $post->save();

        return redirect()->route('home')->with('message','Post Published!');
    }

    // public function list(){
    //     $post=Post::all();
    //     return view('Home.index',['list'=>$post]);
    // }

    public function delete(Post $post){
        if ($post->user->id == Auth::user()->id) {
            $post->delete();
            return back()->with('message','Post Deleted');
        }else {
            return back()->with('fail','You cannot delete this post.');
        }
    }
    public function edit(Post $post, Request $request){
        if ($post->user->id == Auth::user()->id){

            $request->validate([
                'desc'=>'required'
            ]);

            $post->desc=$request->desc;
            $post->save();
            return back()->with('message','Post Updated Successfully!');
        }else {
            return back()->with('fail','You cannot edit this post.');
        }
    }
}
