<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        $this->call(TypeUserTableSeeder::class);
        $this->call(EtatTableSeeder::class);
        $this->call(PrioritéTableSeeder::class);
        $this->call(ProjetTableSeeder::class);
        $this->call(CategorieTableSeeder::class);
        $this->call(UsersTableSeeder::class);
        $this->call(ClientTableSeeder::class);
        $this->call(TicketTableSeeder::class);
    }
}
