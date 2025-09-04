<?php

namespace Database\Seeders;

use App\Models\Departement;
use Illuminate\Database\Seeder;

class DepartementsTableSeeder extends Seeder
{
    public function run()
    {
        Departement::create([
            'nom' => 'Informatique'
        ]);

        Departement::create([
            'nom' => 'Génie Civil'
        ]);
    }
}
