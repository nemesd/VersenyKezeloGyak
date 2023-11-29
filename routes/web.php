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

Route::get('/', function () {
    return view('main', [
        'races' => Race::all(),
        'rounds' => Round::all(),
    ]);
});
Route::post('/addRace', [RaceController::class, 'addRace']);
Route::post('/addRound', [RaceController::class, 'addRound']);
Route::get('/showRounds/{raceid}', [RaceController::class, 'showRounds']);
Route::get('/showRaces', [RaceController::class, 'showRaces']);