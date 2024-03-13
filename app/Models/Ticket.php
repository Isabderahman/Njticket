<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    use HasFactory;
    protected $fillable = [
        'id', 
        'titre_ticket',
        'contenu',
        'date_estime',
        'date_realisation',
        'projet_id',
        'categorie_id',
        'priorite_id', 
        'created_at',
        'updated_at',
        'realisateur_id',
        'type_ticket'
    ];
    
}
