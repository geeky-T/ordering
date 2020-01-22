<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class UserLoginController extends Controller
{
    function index(Request $req)
    {
        //print_r($req->input());

        $users = User::where('email', $req->email)->first();
        if (is_null($users)) {
            $user = new User;
            $user->name = $req->name;
            $user->email = $req->email;
            $user->password = $req->password;
            $user->save();
        }
        else
        {
           json_encode([
               'name' => $users->name,
               'email' => $users->email
           ]);
        }


    }


}
