<?php

namespace Database\Seeders;

use App\Models\Client;
use App\Models\Projet;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ClientTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $projet = Projet::all();
        $users = User::where('type_user',2)->get(['id']);
        foreach ($users as $user) {
            Client::factory()->create([
                'user_id' => $user->id,
                'projet_id' => $projet->random()->id,
            ]);
        }
    }
}
