<?php

namespace App\Http\Controllers;
//use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;


class UserLoginController extends Controller
{
    function login(Request $req)
    {
        // check if user already logged in
        if(
            this.session()->has($req->input('email'))
            &&
            this.session()->get($req->input('email')) == $req->input('password')
        ) return response('User Logged In!', 200);

        // if not get user data from the database
        $users = User::where('email', $req->input('email'))->where('password', $req->input('password'))->first();

        // is user not found return bad request error
        if (is_null($users)) {
            return response()->json(['error' => 'Invalid Email/Password. New User ? Please Register'], 401);
        }
        // store session and respond with ok
        else
        {
            $req->session()->put($req->input('email'), $req->input('password'));
            return response('Login Successful', 200);
        }
    }
    function register(Request $req)
    {
        if($req->session()->has('email')) return response()->json('', '200');
        $users = User::where('email', $req->input('email')->first());

        //checking user already exists
        if ($users) {
            return response()->json(['error'=>'Email already exists. Login please'], 401);
        }
        // if not continue the registration process
        else
        {
            $user = new User();
            $user->name = $req->input('name');
            $user->email = $req->input('email');
//            $user->password = $password = Hash::make($req->input('password'));
            $user->password = $password = $req->input('password');
            $user->save();
            $req->session()->put('email', $req->input('email'));
            return response('Registration Success', 201);
        }
    }



}
