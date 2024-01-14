<?php

namespace App\Http\Controllers\Web;

use Exception;
use App\Models\Race;
use App\Models\Round;
use App\Models\User;
use App\Models\Competitor;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RaceController extends Controller
{
    /**
     * Verseny felvétele az adatbázisba
     * Verseny nevének és évének egyedinek kell lenije
     * @param Request $request
     * @return JsonResponse
     */
    public function addRace(Request $request) : JsonResponse {
        $user = User::where('id', $request->cookie('id'))->first(); // Ellenörzés hogy admin-e
        if($user && $user->admin == 0){
            return response()->json(['message' => 'Nincs hozzá jogosultság', 'type' => 'danger']);
        }
        try{
            // Validáljuk az adatokat
            $this->validate($request, [
                'name'=> 'required|unique:races,name,NULL,id,year,'.$request['year'],
                'year' => 'required|integer',
                'category' => 'required',
                'description' => 'required',
            ]);
        } catch(Exception $e) {
            return response()->json(['message' => 'Hibás adat vagy ilyen már van', 'type' => 'danger']);
        }
        $raceData = [
            'name' => e($request->name),
            'year' => e($request->year),
            'category' => e($request->category),
            'description' => e($request->description)
        ];
        $race = Race::Create($raceData);
        if($race){
            return response()->json(['message' => 'Verseny sikeresen hozzáadva']);
        } else {
            return response()->json(['message' => 'Versenyt nem sikerült felvenni CONTROLLER', 'type' => 'danger']);
        }
    }

    /**
    * Fordulók felvétele az adatbázisba
    * Forduló nevének egyedinek kell lenije
    * @param Request $request
    * @return JsonResponse
    */
    public function addRound(Request $request) : JsonResponse {
        $user = User::where('id', $request->cookie('id'))->first(); // Ellenörzés hogy admin-e
        if($user && $user->admin == 0){
            return response()->json(['message' => 'Nincs hozzá jogosultság', 'type' => 'danger']);
        }
        try{
            // Validáljuk az adatokat
            $this->validate($request, [
                'name'=> 'required|unique:rounds,name,NULL,id,race_id,'.$request['race_id'],
                'race_id' => 'required',
            ]);
        } catch(Exception $e) {
            return response()->json(['message' => 'Már létezik vagy hibás adat', 'type' => 'danger']);
        }
        $roundData = [
            'name' => e($request->name),
            'race_id' => e($request->race_id)
        ];
        $round = Round::Create($roundData);
        if($round){
            return response()->json(['message' => 'Forduló sikeresen hozzáadva']);
        } else {
            return response()->json(['message' => 'Fordulót nem sikerült felvenni CONTROLLER', 'type' => 'danger']);
        }
    }

    /**
     * Versenyző felvétele egy adott fordulóhoz
     * @param Request $request
     * @return JsonResponse
     */
    public function addComp(Request $request) : JsonResponse {
        $user = User::where('id', $request->cookie('id'))->first(); // Ellenörzés hogy admin-e
        if($user && $user->admin == 0){
            return response()->json(['message' => 'Nincs hozzá jogosultság', 'type' => 'danger']);
        }
        try {
            // Validáljuk az adatokat
            $this->validate($request, [
                'user_id' => 'required',
                'round_id' => 'required',
            ]);
    
            // Ellenőrizzük, hogy a versenyző már fel van-e véve az adott fordulóba
            $existingCompetitor = Competitor::where('user_id', $request->user_id)
                                            ->where('round_id', $request->round_id)
                                            ->first();
    
            if ($existingCompetitor) {
                return response()->json(['message' => 'A versenyző már fel van véve az adott fordulóba', 'type' => 'danger']);
            }
    
            // Ha nem létezik, akkor hozzáadjuk
            $competitor = Competitor::create($request->all());
    
            if ($competitor) {
                return response()->json(['message' => 'Versenyző sikeresen hozzáadva']);
            } else {
                return response()->json(['message' => 'Versenyzőt nem sikerült felvenni', 'type' => 'danger']);
            }
        } catch (\Exception $e) {
            return response()->json(['message' => 'Hibás adat', 'type' => 'danger']);
        }
    }

    /**
     * Összes szükséges verseny adatot elküldi
     * @return JsonResponse
     */
    public function showRaces() : JsonResponse {
        return response()->json([
            'races' => Race::select('id', 'name', 'year')->orderBy('id')->get(),
            'rounds' => Round::select('id', 'name', 'race_id')->orderBy('id')->get(),
            'comps' => Competitor::select('user_id', 'round_id')->orderBy('created_at')->get(),
            'users' => User::select('id', 'name')->get()
        ]);
    }
    
    /**
     * Összes felhasználó elküldése abc rendben
     * @param int $roundId
     * @return JsonResponse
     */
    public function listComp(int $roundId) : JsonResponse {
        $users = User::whereDoesntHave('competitors', function ($query) use ($roundId) {
            $query->where('round_id', $roundId);
        })->orderBy('name')->get();
        return response()->json(['users' => $users]);
    }
    
    /**
     * Egy verseny elküldése
     * @param int $raceId
     * @return JsonResponse
     */
    public function infoRace(int $raceId) : JsonResponse {
        $race = Race::find($raceId);
        return response()->json(['race' => $race]);
    }

     /**
     * Egy forduló elküldése
     * @param int $roundId
     * @return JsonResponse
     */
    public function infoRound(int $roundId) : JsonResponse {
        $round = Round::find($roundId);
        return response()->json(['round' => $round]);
    }

    /**
    * Egy versenyző elküldése
    * @param int $roundId
    * @return JsonResponse
    */
    public function infoComp(int $compId) : JsonResponse {
        $competitor = User::find($compId);
        return response()->json(['competitor' => $competitor]);
    }
}
