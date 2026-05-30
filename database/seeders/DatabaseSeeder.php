<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\{AgentSante, CategorieSituation};
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // Données de référence (gestations, vaccins, produits, antécédents...)
        $this->call(ReferenceSeeder::class);

        // Ton compte personnel + 2 agents de test
        $this->call(AgentSanteSeeder::class);

        // Compte principal (propriétaire de l'app)
        $agent = AgentSante::firstOrCreate(
            ['email' => 'hadjasorybintabah@gmail.com'],
            [
                'nom'           => 'Bah',
                'prenom'        => 'Sory binta',
                'adresse'       => 'Lambanyi',
                'telephone'     => '629901136',
                'qualification' => 'Médecin généraliste',
                'admin'         => true,
                'password'      => Hash::make('sangaredi2014'),
            ]
        );
        $agent->update(['admin' => true]);

        CategorieSituation::firstOrCreate(['nom_cat_situation' => 'DERNIER NÉ']);
        CategorieSituation::firstOrCreate(['nom_cat_situation' => 'AVANT DERNIER NÉ']);

        // 13 patientes avec données complètes (uniquement en dev/staging)
        if (app()->environment(['local', 'staging'])) {
            $this->call(PatienteSeeder::class);
        }
    }
}
