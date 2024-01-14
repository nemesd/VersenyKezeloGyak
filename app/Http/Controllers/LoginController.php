<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;

class LoginController extends Controller
{

    /**
     * Bejelentkezéshez authetnikáció és user adatok visszaküldése.
     * Vár emailt és jelszót majd ellenőrzi.
     * @param Request $request
     * @return JsonResponse
     */
    public function login(Request $request) : JsonResponse {
        $request->validate([
            'email' => 'required|string',
            'password' => 'required|string',
        ]);

        $user = User::where('email', $request['email'])->first(); //Adatbázisból kikeresés

        if($user && password_verify($request['password'], $user->password)){ //Jelszó egyeztetés

            Cookie::queue(Cookie::make('user', $user->id, 120)); //User id cookie elmentése

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
    
    /**
     * Megnézi hogy a cookieban van e tárolva user (azaz már volt bejelentkezve) akkor visszaküldi a user adatait ha nem akkor semmit.
     * @param Request $request
     * @return JsonResponse
     */
    public function loggedIn(Request $request) : JsonResponse {
        $user = User::where('id', $request->cookie('user'))->first(); //User kikeresése az adatbázisból
        if($user){
            return response()->json([
                'success' => true,
                'name' => $user->name,
                'email' => $user->email,
                'birthyear' => $user->birthyear,
                'gender' => $user->gender,
                'admin' => $user->admin,
            ]);
        }
        return response()->json([
            'success' => false,
        ]);

    }
    
    /**
     * Kijelentkezéskor kitörli a cookiet.
     * @param Request $request
     * @return JsonResponse
     */
    public function logOut() : JsonResponse {
        Cookie::queue(Cookie::forget('user')); //User id kitörlése a cookiekból
        return response()->json(['Törölve']);
    }
}
