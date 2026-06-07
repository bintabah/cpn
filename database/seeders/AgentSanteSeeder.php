<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AgentSanteSeeder extends Seeder
{
    public function run()
    {
        $agents = [
            [
                'nom'           => 'Admin',
                'prenom'        => 'Super',
                'adresse'       => 'Conakry',
                'email'         => 'admin@cpn.com',
                'telephone'     => '620000000',
                'qualification' => 'Administrateur',
                'password'      => Hash::make('demo1234'),
                'admin'         => true,
            ],
            [
                'nom'           => 'Diallo',
                'prenom'        => 'Aissatou',
                'adresse'       => 'Ratoma',
                'email'         => 'aissatou.diallo@cpn.com',
                'telephone'     => '621100001',
                'qualification' => 'Sage-femme',
                'password'      => Hash::make('demo1234'),
                'admin'         => false,
            ],
            [
                'nom'           => 'Camara',
                'prenom'        => 'Ibrahima',
                'adresse'       => 'Dixinn',
                'email'         => 'ibrahima.camara@cpn.com',
                'telephone'     => '622200002',
                'qualification' => 'Médecin',
                'password'      => Hash::make('demo1234'),
                'admin'         => false,
            ],
        ];

        foreach ($agents as $agent) {
            $existing = DB::table('agent_sante')->where('email', $agent['email'])->first();
            if ($existing) {
                DB::table('agent_sante')->where('email', $agent['email'])
                    ->update(['password' => $agent['password']]);
            } else {
                DB::table('agent_sante')->insert($agent);
            }
        }
    }
}
