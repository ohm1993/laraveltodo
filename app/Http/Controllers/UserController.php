<?php

namespace App\Http\Controllers;

use Auth;
use App\User;
use Validator;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function init(){
        $user = Auth::user();
        return response()->json(['user'=> $user],200);
    }
    
    public function login(Request $request)
    {
        if (Auth::attempt(['email' => request('email'), 'password' => request('password')],true)) {
            return response()->json(Auth::user(),200);
        }else{
            return response()->json(['error' => 'could not you login'],401);
        }
    }

    public function register(Request $request)
    {
        $user = User::where('email',$request->email)->first();
        if(isset($user->id)){
            return response()->json(['error'=>'email already registed'],401);
        }
        $data = $request->only(['name', 'email', 'password']);
        $data['password'] = bcrypt($data['password']);
        $user = User::create($data);
        Auth::login($user);
        return response()->json($user,200);
    }

    public function logout(){
        Auth::logout();
    }
}
