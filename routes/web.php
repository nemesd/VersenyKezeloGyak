<?php

use App\Http\Controllers\RaceController;
use App\Models\Race;
use App\Models\Round;
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

Route::get('/', function () { return view('main'); });
Route::get('/showRaces', [RaceController::class, 'showRaces']);
Route::get('/showRounds/{raceid}', [RaceController::class, 'showRounds']);
Route::get('/showComp/{roundid}', [RaceController::class, 'showComp']);
Route::get('/listComp', [RaceController::class, 'listComp']);
Route::get('/infoRace/{raceid}', [RaceController::class, 'infoRace']);
Route::get('/infoRound/{roundid}', [RaceController::class, 'infoRound']);
Route::get('/infoComp/{compid}', [RaceController::class, 'infoComp']);

Route::post('/addRace', [RaceController::class, 'addRace']);
Route::post('/addRound', [RaceController::class, 'addRound']);
Route::post('/addComp', [RaceController::class, 'addComp']);
