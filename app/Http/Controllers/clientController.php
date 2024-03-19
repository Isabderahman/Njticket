<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreClientRequest;
use App\Http\Requests\UpdateClientRequest;
use App\Models\Client;
use App\Models\Projet;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ClientController extends Controller
{
    public function __construct()
    {
        $user = Auth::guard('sanctum')->user();

        if ($user && $user->type_user == 1) {
            $this->middleware('IsAdmin');
        } elseif ($user && $user->type_user == 2) {
            $this->middleware('IsClient')->except('destroy', 'index');
        }
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
        // Vérifier si l'ID du projet existe
        $projet = Projet::find($request->projet_id);

        if (!$projet) {
            return response()->json(['message' => 'L\'ID du projet est incorrect'], 400);
        }

        // Créer un nouvel utilisateur
        $user = User::create([
            "nom" => $request->nom,
            "prenom" => $request->prenom,
            "email" => $request->email,
            "password" => bcrypt($request->password), // Assurez-vous de hasher le mot de passe
            "type_user" => 2
        ]);

        // Vérifier si l'utilisateur a été créé avec succès
        if (!$user) {
            return response()->json(["message" => "Une erreur est survenue lors de la création de l'utilisateur"], 500);
        }

        // Créer un nouveau client associé à l'utilisateur
        $client = Client::create([
            "profile" => $request->profile,
            "entreprise" => $request->entreprise,
            "projet_id" => $request->projet_id,
            "user_id" => $user->id, // Utilisez l'ID de l'utilisateur créé
        ]);

        // Vérifier si le client a été créé avec succès
        if ($client) {
            return response()->json(["message" => "Le client a été ajouté avec succès"], 201);
        } else {
            // Supprimer l'utilisateur créé en cas d'échec de création du client
            $user->delete();
            return response()->json(["message" => "Une erreur est survenue lors de la création du client"], 500);
        }
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // Vérifier si le client existe
        $client = Client::find($id);
        if (!$client) {
            return response()->json(["message" => "Le client $id n'existe pas"], 404);
        }
    
        // Vérifier les autorisations de l'utilisateur
        $userId = Auth::guard('sanctum')->user();
        if ($userId->type_user == 2 && $client->user_id !== $userId->id) {
            return response()->json(["message" => "Vous n'avez pas accès à ce client"], 403);
        }
    
        // Retourner les détails du client
        return $client;
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
    public function update(UpdateClientRequest $request, Client $client, string $id)
    {
        // Vérifier si le client existe
        $client = Client::find($id);
        if (!$client) {
            return response()->json(["message" => "Le client $id n'existe pas"], 404);
        }
    
        // Vérifier les autorisations de l'utilisateur
        $userId = Auth::guard('sanctum')->user();
        if ($userId->type_user == 2 && $client->user_id !== $userId->id) {
            return response()->json(["message" => "Vous n'êtes pas autorisé à mettre à jour ce client"], 403);
        }
    
        // Effectuer la mise à jour du client
        if ($client->update($request->all())) {
            return response()->json(['message' => 'Le client a été mis à jour avec succès']);
        } else {
            return response()->json(['message' => 'Une erreur s\'est produite lors de la mise à jour du client'], 500);
        }
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
