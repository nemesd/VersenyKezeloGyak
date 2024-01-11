<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\RaceController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::get('/', function () { return view('main'); });

Route::get('/showRaces', [RaceController::class, 'showRaces']);

Route::get('/listComp', [RaceController::class, 'listComp']);

Route::get('/infoRace/{raceid}', [RaceController::class, 'infoRace']);
Route::get('/infoRound/{roundid}', [RaceController::class, 'infoRound']);
Route::get('/infoComp/{compid}', [RaceController::class, 'infoComp']);

Route::post('/login', [LoginController::class, 'login']);
Route::post('/loggedIn', [LoginController::class, 'loggedIn']);
Route::post('/logOut', [LoginController::class, 'logOut']);

Route::post('/addRace', [RaceController::class, 'addRace']);
Route::post('/addRound', [RaceController::class, 'addRound']);
Route::post('/addComp', [RaceController::class, 'addComp']);

