<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AgentSanteSeeder extends Seeder
{
    public function run()
    {
        DB::table('agent_sante')->insertOrIgnore([
            [
                'nom'           => 'Admin',
                'prenom'        => 'Super',
                'adresse'       => 'Conakry',
                'email'         => 'admin@cpn.com',
                'telephone'     => '620000000',
                'qualification' => 'Administrateur',
                'password'      => Hash::make('password123'),
                'admin'         => true,
            ],
            [
                'nom'           => 'Diallo',
                'prenom'        => 'Aissatou',
                'adresse'       => 'Ratoma',
                'email'         => 'aissatou.diallo@cpn.com',
                'telephone'     => '621100001',
                'qualification' => 'Sage-femme',
                'password'      => Hash::make('password123'),
                'admin'         => false,
            ],
            [
                'nom'           => 'Camara',
                'prenom'        => 'Ibrahima',
                'adresse'       => 'Dixinn',
                'email'         => 'ibrahima.camara@cpn.com',
                'telephone'     => '622200002',
                'qualification' => 'Médecin',
                'password'      => Hash::make('password123'),
                'admin'         => false,
            ],
        ]);
    }
}
