<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Race;
use App\Models\Round;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

use function Laravel\Prompts\error;

class RaceController extends Controller
{
    public function addRace(Request $request) : JsonResponse {
        try{
            // Validáljuk az adatokat
            $this->validate($request, [
                'name'=> 'required',
                'year' => 'required',
            ]);
        } catch(Exception $e) {
            return response()->json(['message' => 'Hibás adat', 'type' => 'danger']);
        }

        $race = Race::Create($request->all());
        if($race){
            return response()->json(['message' => 'Adat sikeresen hozzáadva']);
        } else {
            return response()->json(['message' => 'Adatot nem sikerült felvenni CONTROLLER', 'type' => 'danger']);
        }
    }
    public function addRound(Request $request) : JsonResponse {
        try{
            // Validáljuk az adatokat
            $this->validate($request, [
                'name'=> 'required',
                'race_id' => 'required',
            ]);
        } catch(Exception $e) {
            return response()->json(['message' => 'Hibás adat', 'type' => 'danger']);
        }

        $race = Round::Create($request->all());
        if($race){
            return response()->json(['message' => 'Adat sikeresen hozzáadva']);
        } else {
            return response()->json(['message' => 'Adatot nem sikerült felvenni CONTROLLER', 'type' => 'danger']);
        }
    }
    
    public function showRounds(int $raceid) : JsonResponse {
        $race = Race::find($raceid);
        $rounds = $race->rounds;
        return response()->json(['rounds' => $rounds]);
    }

    public function showRaces() : JsonResponse {
        $races = Race::all();
        return response()->json(['races' => $races]);
    }
}
