<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTicketRequest;
use App\Http\Requests\UpdateTicketRequest;
use App\Models\Categorie;
use App\Models\Etat;
use App\Models\Historique;
use App\Models\Priorite;
use App\Models\Projet;
use App\Models\Ticket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TicketsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function __construct()
    {
        $userType = Auth::guard('sanctum')->user()->type_user;

        if ($userType == 1) {
            $this->middleware('IsAdmin');
        } elseif ($userType == 3) {
            $this->middleware('IsRealisateur')->only('update');
        } else {
            $this->middleware('IsClient')->only('store', 'show');
        }
        
    }
    public function index()
    {
        return Ticket::all();
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
    public function store(StoreTicketRequest $request)
    {
        $existProjetId = Projet::find($request->projet_id);
        $exisCategorieId = Categorie::find($request->categorie_id);
        $existPrioriteId = Priorite::find($request->priorite_id);
        $existEtatId = Etat::find($request->etat_id);
        if ($exisCategorieId == null) {
            return response()->json(['message' => 'CategorieId est incorrect']);
        } elseif ($existProjetId == null) {
            return response()->json(['message' => 'ProjetId est incorrect']);
        } elseif ($existPrioriteId == null) {
            return response()->json(['message' => 'PrioriteId est incorrect']);
        } elseif ($existEtatId == null) {
            return response()->json(['message' => 'EtatId ID est incorrect']);
        } else {
            $result = Ticket::create($request->all());
            if ($result) {
                return response()->json(["message" => "le ticket $request->id est ajouter"]);
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
        $ticket = Ticket::find((int)$id);
        if ($ticket) {
            return $ticket;
        } else {
            return ["ereur" => "somethings wrong"];
        };
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
    public function update(UpdateTicketRequest $request, Ticket $ticket, Historique $historique)
    {

        if ($ticket->update([
            'id' => $request->id,
            'titre_ticket' => $request->titre_ticket,
            'contenu' => $request->contenu,
            'date_estime' => $request->date_estime,
            'date_realisation' => $request->date_realisation,
            'projet_id' => $request->projet_id,
            'categorie_id' => $request->categorie_id,
            'priorite_id' => $request->priorite_id,
            'created_at' => $request->created_at,
            'updated_at' => $request->updated_at,
            'realisateur_id' => $request->realisateur_id,
            'type_ticket' => $request->type_ticket
        ])) {
            $historique->create([
                "description_modification" => $request->description_modification,
                "modificateur_id" => $request->realisateur_id,
                "ticket_id" => $request->id
            ]);
            return response()->json(['message' => ' ticket has updated successfully']);
        } else {
            return response()->json(['message' => 'somethings wrong']);
        };
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $ticket = Ticket::find($id);
        $resultat = $ticket->delete();
        if ($resultat) {
            return response()->json(["message" => "le ticket avec l'Id $id est supprimer"]);
        } else {
            return response()->json(["message" => "somethings wrong"]);
        }
    }
}
