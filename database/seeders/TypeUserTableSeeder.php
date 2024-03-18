<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

use function PHPSTORM_META\type;

class TypeUserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $types = ["admin", "client", "réalisateur", "observateur"];
        foreach ($types as $type) {
            DB::table('type_users')->insert([
                'type_user' => $type
            ]);
        }
    }
}
