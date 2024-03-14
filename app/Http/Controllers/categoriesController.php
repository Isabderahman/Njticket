<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCategorieRequest;
use App\Http\Requests\UpdateCategorieRequest;
use App\Models\Categorie;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

class CategoriesController extends Controller
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
        return Categorie::all();
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
    public function store(StoreCategorieRequest $request)
    {
        //
        $existingCategorie = Categorie::where('type_categorie', $request->type_categorie)->first();
        if ($existingCategorie) {
            return response()->json(["message" => "ce Categorie est déja créer"]);
        } else {
            $result = Categorie::create($request->all());
            if ($result) {
                return response()->json(["message" => "la Categorie $request->type_categorie est ajouter"]);
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
        $categorie = Categorie::find($id);
        if ($categorie) {
            return $categorie;
        } else {
            return response()->json(["ereur" => "ne trouve aucune Categorie avec ce id"]);
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


    public function update(UpdateCategorieRequest $request, Categorie $categorie)
    {
        try {
            $categorie->update($request->all());
    
            return response()->json(['message' => 'Categorie updated successfully'], 200);
        } catch (QueryException $e) {
            return response()->json(['message' => 'Something went wrong'], 500);
        }
    }
    

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $categorie = Categorie::find($id);
        $resultat = $categorie->delete();
        if ($resultat) {
            return response()->json(["message" => "le categorie $id est supprimer"]);
        } else {
            return response()->json(["message" => "somethings wrong"]);
        }
    }
}
