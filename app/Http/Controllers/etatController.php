<?php

namespace App\Http\Controllers;

use App\Http\Requests\storeEtatRequest;
use App\Http\Requests\updateEtatRequest;
use App\Models\Etat;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

class etatController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        return Etat::all();
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
    public function store(storeEtatRequest $request)
    {
        //
        $existingEtat = Etat::where('type_etat', $request->type_etat)->first();
        if ($existingEtat) {
            return response()->json(["message" => "cette état est déja créer"]);
        } else {
            $result = Etat::create($request->all());
            if ($result) {
                return response()->json(["message" => " $request->type_etat est ajouter"]);
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
        $etat = Etat::find($id);
        if ($etat) {
            return $etat;
        } else {
            return response()->json(["ereur" => "il n'y a pas aucun etat avec ce id"]);
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
    public function update(updateEtatRequest $request,  Etat $etat)
    {
        //
        try {
            $etat->update($request->all());

            return response()->json(['message' => 'Categorie updated successfully'], 200);
        } catch (QueryException $e) {
            return response()->json([
                'message' => 'Something went wrong', 
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $etat = Etat::find($id);
        $resultat = $etat->delete();
        if ($resultat) {
            return response()->json(["message" => "l'etat $id est supprimer"]);
        } else {
            return response()->json(["message" => "somethings wrong"]);
        }
    }
}
