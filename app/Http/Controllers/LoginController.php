<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class LoginController extends Controller
{

    //Bejelentkezés
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);

        $user = User::where('email', $request['email'])->first(); //Adatbázisból kikeresés

        if($user && password_verify($request['password'], $user->password)){ //Jelszó egyeztetés
            return response()->json([
                'success' => true,
                'name' => $user->name,
                'email' => $user->email,
                'birthyear' => $user->birthyear,
                'gender' => $user->gender,
                'admin' => $user->admin
            ]);
        } else {
            return response()->json([
                'success' => false, 
                'message' => 'Invalid login credentials'
            ]);
        }
    }
}
