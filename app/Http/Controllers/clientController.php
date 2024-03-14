<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreClientRequest;
use App\Http\Requests\UpdateClientRequest;
use App\Models\Client;
use App\Models\Projet;
use App\Models\User;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    public function __construct()
    {
        $this->middleware('Auth');
        $this->middleware('IsAdmin')->only('index','dstroy');
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        return Client::all();
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
    public function store(StoreClientRequest $request)
    {
        //
        $existProjetId = Projet::find($request->projet_id);


        if($existProjetId == null) {
            return response()->json(['message' => 'Project ID est incorrect']);
        } else {
            User::create([
                "nom" => $request->nom,
                "prenom" => $request->prenom,
                "email" => $request->email,
                "password" => $request->password,
                "type_user"=> 2
            ]);
            $UserID = User::find($request->email);
            $result = Client::create([
                "profile" => $request->profile,
                "entreprise" => $request->entreprise,
                "projet_id" => $request->projet_id,
                "user_ID" => $UserID->id,
            ]);
            if ($result) {
                return response()->json(["message" => "le client $request->id est ajouter"]);
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
        $client = Client::find($id);
        if ($client) {
            return $client;
        } else {
            return response()->json(["message" => "le client $id n'est exicit pas"]);
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
    public function update(UpdateClientRequest $request, Client $client)
    {
        if ($client->update($request->all())) {
            return response()->json(['message' => 'le client updated successfully']);
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
        $client = User::find($id);
        $resultat = $client->delete();
        if ($resultat) {
            return response()->json(["message" => "le client avec l'Id $id est supprimer"]);
        } else {
            return response()->json(["message" => "somethings wrong"]);
        }
    }
}
