<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Historique extends Model
{
    use HasFactory;
    protected $fillable =['id','description_modification','created_at','updated_at','modificateur_id','ticket_id'];
}
