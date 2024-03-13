<?php

namespace App\Http\Controllers;

use App\Models\Historique;
use Illuminate\Http\Request;

class HistoriqueController extends Controller
{
    public function show(string $ticket)
    {
        return Historique::where('ticket_id', (int)$ticket)->get();
    }
}
