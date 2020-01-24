<?php

namespace App\Http\Controllers;
//use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;


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
            return response()->json([
                'message'=>'Welcome '.$users->name,
                'email' => $users->email
            ]);
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
            $user->name = $req->name;
            $user->email = $req->email;
            $user->password = $req->password;
            $user->save();
            return response()->json(['message'=>'registration success']);
        }

    }



}
