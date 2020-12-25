<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserAuthController extends Controller
{
    public function register(Request $request){

        if($request->getMethod()=="POST"){
            $request->validate([
                'name'=>'required',
                'email'=>'required|email|unique:users',
                'password'=>'required|min:6'
            ]);

            $user = new User();
            $user->name=$request->name;
            $user->email=$request->email;
            $user->password=Hash::make($request->password);
            // dd($user);
            $user->save();
            return redirect()->route('login');
        }else{

            return view('auth.register');
        }
    }

    public function login(Request $request){
        if ($request->getMethod()=="POST") {
           if( !Auth::attempt(['email' => $request->email, 'password' => $request->password])){
                return redirect()->back()->withErrors('username password wrong');
            }else{
                if (Auth::user()->profile!==NULL) {
                    return redirect()->route('home');
                }else {
                    return redirect()->route('profile.upload');
                }
            }
        }else {
            return view('auth.login');
        }
    }

    public function logout(Request $request){
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}
