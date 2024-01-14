<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\Web\RaceController;
use App\Models\Competitor;
use App\Models\Race;
use App\Models\Round;
use App\Models\User;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () { return view('main', [
    'races' => Race::all(),
    'rounds' => Round::all(),
    'competitors' => Competitor::all(),
    'users' => User::all(),
    'admin' => User::where('id', Cookie::get('user'))->first()->admin,
    'name' => User::where('id', Cookie::get('user'))->first()->name
]); });

Route::get('/showRaces', [RaceController::class, 'showRaces']);

Route::get('/listComp/{round}', [RaceController::class, 'listComp']);

Route::get('/infoRace/{raceid}', [RaceController::class, 'infoRace']);
Route::get('/infoRound/{roundid}', [RaceController::class, 'infoRound']);
Route::get('/infoComp/{compid}', [RaceController::class, 'infoComp']);

Route::post('/login', [LoginController::class, 'login']);
Route::post('/loggedIn', [LoginController::class, 'loggedIn']);
Route::post('/logOut', [LoginController::class, 'logOut']);

Route::post('/addRace', [RaceController::class, 'addRace']);
Route::post('/addRound', [RaceController::class, 'addRound']);
Route::post('/addComp', [RaceController::class, 'addComp']);
