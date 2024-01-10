<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;

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
        
        $cookie = cookie('admin', 1, 120);


        if($user && password_verify($request['password'], $user->password)){ //Jelszó egyeztetés

            Cookie::queue(Cookie::make('name', $user->name, 120));
            Cookie::queue(Cookie::make('email', $user->email, 120));
            Cookie::queue(Cookie::make('birthyear', $user->birthyear, 120));
            Cookie::queue(Cookie::make('gender', $user->gender, 120));
            Cookie::queue(Cookie::make('admin', $user->admin, 120));

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
                'message' => 'Helytelen belépési adatok'
            ]);
        }
    }

    public function loggedIn(Request $request){
        if($request->cookie($request['name']) !== ''){
            return response()->json([
                'success' => true,
                'name' => $request->cookie('name'),
                'email' => $request->cookie('email'),
                'birthyear' => $request->cookie('birthyear'),
                'gender' => $request->cookie('gender'),
                'admin' => $request->cookie('admin'),
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Nincs mentett felhasználó'
            ]);
        }
    }

    public function logOut(){
        Cookie::queue(Cookie::forget('name'));
        Cookie::queue(Cookie::forget('email'));
        Cookie::queue(Cookie::forget('birthyear'));
        Cookie::queue(Cookie::forget('gender'));
        Cookie::queue(Cookie::forget('admin'));
        return response()->json(['Törölve']);
    }
}
