<?php

namespace Database\Seeders;

use App\Models\Filiere;
use Illuminate\Database\Seeder;

class FilieresTableSeeder extends Seeder
{
    public function run()
    {
        Filiere::create([
            'nom' => 'Génie Logiciel',
            'departement_id' => 1
        ]);

        Filiere::create([
            'nom' => 'Réseaux et Systèmes',
            'departement_id' => 1
        ]);

        Filiere::create([
            'nom' => 'Construction',
            'departement_id' => 2
        ]);
    }
}
