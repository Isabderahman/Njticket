<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCommentaireRequest;
use App\Http\Requests\UpdateCommentaireRequest;
use App\Models\Commentaire;
use Illuminate\Http\Request;

class CommentaireController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function __construct()
    {
        $this->middleware('Auth');
    }
    public function index()
    {       
        return Commentaire::all();
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
    public function store(StoreCommentaireRequest $request)
    {
        $result = Commentaire::create($request->all());
            if ($result) {
                return response()->json(["message" => "le commentaire est ajouter"]);
            } else {
                return response()->json(["message" => "somethings wrong"]);
            }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $ticket)
    {
        //
        return Commentaire::where('ticket_id', (int)$ticket)->get();
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Commentaire $commentaire)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCommentaireRequest $request, Commentaire $commentaire)
    {
        //
        if ($commentaire->update($request->all())) {
            return response()->json(['message' => 'commentaire has updated successfully']);
        } else {
            return response()->json(['message' => 'somethings wrong']);
        };
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $commentaire = Commentaire::find($id);
        $resultat = $commentaire->delete();
        if ($resultat) {
            return response()->json(["message" => "le commentaire est supprimer"]);
        } else {
            return response()->json(["message" => "somethings wrong"]);
        }
    }
}
