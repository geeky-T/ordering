<?php

namespace App\Http\Controllers;
//use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;


class UserLoginController extends Controller
{
    function login(Request $req)
    {
        //print_r($req->input());

        $users = User::where('email', $req->email)->first();
        if (is_null($users)) {
            return response()->json(['error'=>'No email exists.Please register'], 401);
        }
        else {
            if(Hash::check($req->password,$users->password))
            {
                return response('Login Successful', 200);
            }
            else
                {
                    return response('Login Failed', 401);
                }

        }
    }
    function register(Request $req)
    {
        $users = User::where('email', $req->email)->first();
        if ($users) {
            return response()->json(['error'=>'Email already exists. Login please'], 401);
        }
        else
        {
            $user = new User();
            $user->name = $req->input('name');
            $user->email = $req->input('email');
            $user->password = $password = Hash::make($req->password);;
            //$user->password = $password = $req->input('password');
            $user->save();
            return response()->json(['message'=>'registration success']);
        }

    }



}
