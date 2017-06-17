<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Support\Session;

class User extends Controller
{
    public function login(Request $request)
    {
        if (!$request->has(['name', 'password']))
        {
            return response()->json(['message' => 'Bad Request!'], 400);
        }
        $user = \App\User::where('name', $request->input('name'))->first();
        if (null == $user or !password_verify($request->input('password'), $user->password))
        {
            return response()->json(['message' => 'Authenticate failed!'], 401);
        }
        Session::set('user.model', $user);
        return response()->json($user);
    }

    public function profile()
    {
        $user = Session::get('user.model');
        if (null == $user)
        {
            Session::destroy();
            return response()->json(['message' => 'Authenticate failed!'], 401);
        }
        return response()->json($user);
    }

    public function logout()
    {
        Session::destroy();
        return response()->json(['message' => 'Done!']);
    }
}
