<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EtatTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $etats = ["Nouveau", "en attent", "en cours", "résolu", "fermé"];
        foreach ($etats as $etat) {
            DB::table('etats')->insert([
                'type_etat' => $etat
            ]);
        }
    }
}
