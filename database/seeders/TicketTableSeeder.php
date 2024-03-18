<?php

namespace Database\Seeders;

use App\Models\Categorie;
use App\Models\Etat;
use App\Models\Priorite;
use App\Models\Projet;
use App\Models\Ticket;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TicketTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $projet = Projet::all();
        $realisateurs = User::where('type_user', 3)->get();
        $categorie_id = Categorie::all();
        $priorite_id = Priorite::all();
        $etat_id = Etat::all();
        Ticket::factory(20)
            ->sequence(
                fn () =>
                [
                    'realisateur_id' => $realisateurs->random(),
                    'projet_id' => $projet->random(),
                    'categorie_id' => $categorie_id->random(),
                    'priorite_id' => $priorite_id->random(),
                    'etat_id' => $etat_id->random()
                ]
            )->create();
    }
}
