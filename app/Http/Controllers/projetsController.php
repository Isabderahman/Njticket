<?php

namespace App\Http\Controllers;

use App\Http\Requests\storeProjetRequest;
use App\Http\Requests\updateProjetRequest;
use App\Models\Client;
use App\Models\Projet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProjetsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function __construct()
    {
        $user = Auth::guard('sanctum')->user();
        if ($user && $user->type_user == 1) {
            $this->middleware('IsAdmin');
        } elseif ($user && $user->type_user == 2) {
            $this->middleware('IsClient')->only('store', 'show','index');
        }      
        // $this->middleware('IsAdmin');
        // $this->middleware('Client')->only('show');
    }
    public function index()
    {
        //
        $user = Auth::guard('sanctum')->user();
        if ($user && ($user->type_user == 1 || $user->type_user == 3 || $user->type_user == 4)){
            return Projet::all();
        }else{
            $userID = Auth::guard('sanctum')->user()->user_id;
            $projets = Client::where('user_id', $userID)->pluck('projet_id')->toArray();
            $listProjet = Projet::whereIn('id', $projets)->get();
            return $listProjet;
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProjetRequest $request)
    {
        //
        $existingProject = Projet::where('nom_projet', $request->nom_projet)->first();
        if ($existingProject) {
            return response()->json(["message" => "ce projet est déja créer"]);
        } else {
            $result = Projet::create($request->all());
            if ($result) {
                return response()->json(["message" => "le projet $request->id est ajouter"]);
            } else {
                return response()->json(["message" => "somethings wrong"]);
            }
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //

        $projet = Projet::find($id);
        if ($projet) {
            return $projet;
        } else {
            return response()->json(["ereur" => "non projet avec ce id"]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProjetRequest $request , Projet $projet)
    {
        //
        if ($projet->update($request->all())) {
            return response()->json(['message' => 'Project updated successfully']);
        } else {
            return response()->json(['message' => 'somethings wrong']);
        };
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $projet = Projet::find($id);
        $resultat = $projet->delete();
        if ($resultat) {
            return response()->json(["message" => "le projet $id est supprimer"]);
        } else {
            return response()->json(["message" => "somethings wrong"]);
        }
    }
}
