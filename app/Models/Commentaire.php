<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Commentaire extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'created_at',
        'updated_at',
        'contenu',
        'commentateur_id',
        'ticket_id'
    ];
}
