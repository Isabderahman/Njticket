<?php

namespace Database\Seeders;

use App\Models\TypeUser;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $typeUser = TypeUser::all();
        User::factory(20)
            ->sequence(fn () =>
            ['type_user' => $typeUser->random()])
            ->create();
    }
}
