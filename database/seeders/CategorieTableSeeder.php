<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorieTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            "Problèmes matériels", "Problèmes logiciels",
            "Sécurité informatique", "Support utilisateur",
            "Infrastructure informatique", "Maintenance préventive",
            "Demandes de développement ou d'intégration", "Gestion des incidents"
        ];
        foreach ($categories as $cat){
            DB::table('categories')->insert([
                'type_categorie'=>$cat
            ]);
        }
    }
}
