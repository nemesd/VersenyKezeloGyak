<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Race;
use App\Models\Round;
use App\Models\User;
use App\Models\Competitor;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class RaceController extends Controller
{
    /**
     * Verseny felvétele az adatbázisba
     * Verseny nevének és évének egyedinek kell lenije
     * @param Request $request
     * @return JsonResponse
     */
    public function addRace(Request $request) : JsonResponse {
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

        $race = Race::Create($request->all());
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
        try{
            // Validáljuk az adatokat
            $this->validate($request, [
                'name'=> 'required|unique:rounds,name,NULL,id,race_id,'.$request['race_id'],
                'race_id' => 'required',
            ]);
        } catch(Exception $e) {
            return response()->json(['message' => 'Hibás adat', 'type' => 'danger']);
        }

        $race = Round::Create($request->all());
        if($race){
            return response()->json(['message' => 'Forduló sikeresen hozzáadva']);
        } else {
            return response()->json(['message' => 'Fordulót nem sikerült felvenni CONTROLLER', 'type' => 'danger']);
        }
    }

    /**
     * Összes forduló elküldése
     * @return JsonResponse
     */
    public function showRounds(int $raceid) : JsonResponse {
        $race = Race::find($raceid);
        $rounds = $race->rounds;
        return response()->json(['rounds' => $rounds]);
    }
    
    /**
     * Összes felhasználó elküldése
     * @return JsonResponse
     */
    public function listComp() : JsonResponse {
        $users = User::all();
        return response()->json(['users' => $users]);
    }
    
    /**
     * Összes verseny elküldése
     * @return JsonResponse
     */
    public function showRaces() : JsonResponse {
        $races = Race::all();
        return response()->json(['races' => $races]);
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

    /**
     * Versenyző felvétele egy adott fordulóhoz
     * @param Request $request
     * @return JsonResponse
     */
    public function addComp(Request $request) : JsonResponse {
        try{
            // Validáljuk az adatokat
            $this->validate($request, [
                'user_id'=> 'required',
                'round_id' => 'required',
            ]);
        } catch(Exception $e) {
            return response()->json(['message' => 'Hibás adat', 'type' => 'danger']);
        }

        $competitor = Competitor::Create($request->all());
        if($competitor){
            return response()->json(['message' => 'Versenyző sikeresen hozzáadva']);
        } else {
            return response()->json(['message' => 'Versenyzőt nem sikerült felvenni', 'type' => 'danger']);
        }
    }

    /**
     * Versenyzők elküldése egy adott fordulóhoz
     * @param int $roundid
     * @return JsonResponse
     */
    public function showComp(int $roundid) : JsonResponse {
        $round = Round::find($roundid);
        $competitors = $round->competitors;
        $users = $competitors->map(function ($competitor){
            return User::find($competitor->user_id);
        });
        return response()->json(['users' => $users]);
    }
}
