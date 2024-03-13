<?php

namespace App\Http\Controllers;

use App\Http\Requests\storeUsersRequest;
use App\Http\Requests\updateUsersRequest;
use App\Models\User;
use Illuminate\Http\Request;

class userController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        return User::all();
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
    public function store(storeUsersRequest $request)
    {
        //
        $existingUser = User::where('email', $request->email)->first();
        if ($existingUser) {
            return response()->json(["message" => "ce user a déja un compte"]);
        } else {
            $result = User::create([
                'nom' => $request->nom,
                'prenom' => $request->prenom,
                'email' => $request->email,
                'password' => bcrypt($request->password),
                'type_user' =>$request->type_user,
                // Add other fields as needed
            ]);
            if ($result) {
                return response()->json(["message" => "l'user $request->id est ajouter"]);
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
        $user = User::find($id);
        if ($user) {
            return $user;
        } else {
            return response()->json(["ereur" => "aucun user avec ce id"]);
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
    public function update(updateUsersRequest $request, User $user)
    {
        if ($user->update($request->all())) {
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
        $projet = User::find($id);
        $resultat = $projet->delete();
        if ($resultat) {
            return response()->json(["message" => "l'user $id est supprimer"]);
        } else {
            return response()->json(["message" => "somethings wrong"]);
        }
    }
}
