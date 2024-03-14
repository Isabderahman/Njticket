<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePrioriteRequest;
use App\Http\Requests\UpdatePrioriteRequest;
use App\Models\Priorite;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

class PrioriteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function __construct()
    {
        $this->middleware('IsAdmin');
    }
    public function index()
    {
        //
        Priorite::all();
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
    public function store(StorePrioriteRequest $request)
    {
        $existingPriorite = Priorite::where('type_priorite', $request->type_priorite)->first();
        if ($existingPriorite) {
            return response()->json(["message" => "cette Prioriter est déja créer"]);
        } else {
            $result = Priorite::create($request->all());
            if ($result) {
                return response()->json(["message" => " $request->type_priorite est ajouter"]);
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
        $etat = Priorite::find($id);
        if ($etat) {
            return $etat;
        } else {
            return response()->json(["ereur" => "aucun result"]);
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
    public function update(UpdatePrioriteRequest $request, Priorite $priorite)
    {
        try {
            $priorite->update($request->all());

            return response()->json(['message' => 'Etat updated successfully'], 200);
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
        $etat = Priorite::find($id);
        $resultat = $etat->delete();
        if ($resultat) {
            return response()->json(["message" => " la supression est fait correctement "]);
        } else {
            return response()->json(["message" => "somethings wrong"]);
        }
    }
}
