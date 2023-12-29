<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);

        $user = User::where('email', $request['email'])->first();

        if($user && password_verify($request['password'], $user->password)){
            Auth::login($user);
            return response()->json(['success' => true, 'name' => $user->name, 'email' => $user->email, 'birthyear' => $user->birthyear, 'gender' => $user->gender, 'admin' => $user->admin]);
        } else {
            return response()->json(['success' => false, 'message' => 'Invalid login credentials']);
        }


        /*if (Auth::attempt(['email' => $request->input('email'), 'password' => $request->input('pwd')])) {
            $user = Auth::user();
            return response()->json(['success' => true, 'user' => $user]);
        } else {
            return response()->json(['success' => false, 'message' => 'Invalid login credentials']);
        }*/
    }
}
