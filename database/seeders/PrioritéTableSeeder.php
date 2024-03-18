<?php

namespace Database\Seeders;

use App\Models\Priorite;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PrioritéTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $priorites = ["Immédiat", "trés urgent", "urgent", "standard", "faible"];

        foreach ($priorites as $priorite) {

            DB::table('priorites')->insert([
                'type_priorite' => $priorite
            ]);
        }
    }
}
