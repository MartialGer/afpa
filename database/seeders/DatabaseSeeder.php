<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Visibilite;
use App\Models\Etat;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

        $visibilites = ['confidentiel', 'privé', 'public'];
        $etats = ['en cours', 'publié', 'archivé'];
       
        
        foreach ($visibilites as $visibilite) {
            Visibilite::factory()->create([
                'nom' => $visibilite,
            ]);
        }
        foreach ($etats as $etat) {
            Etat::factory()->create([
                'nom' => $etat,
            ]);
        }
       
        /* Visibilite::factory(3)->create(); */
        /* Etat::factory(3)->create(); */
        /*  Type_Media::factory(2)->create(); */
        

        
    }
}
