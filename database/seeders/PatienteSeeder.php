<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class PatienteSeeder extends Seeder
{
    private array $noms     = ['Diallo','Barry','Bah','Sow','Camara','Sylla','Kouyaté','Touré','Condé','Bangoura','Cissé','Konaté'];
    private array $prenoms  = ['Mariama','Fatoumata','Kadiatou','Aissatou','Hawa','Aminata','Nafissatou','Ramatoulaye','Oumou','Mariam','Khadidiatou','Djénabou'];
    private array $prenomH  = ['Mamadou','Alpha','Ibrahima','Oumar','Sekou','Thierno','Aboubacar','Mohamed','Amadou','Lansana','Fodé','Elhadj'];
    private array $quartiers = ['Ratoma','Dixinn','Matam','Kaloum','Matoto','Cosa','Nongo','Lambangui','Coleah','Bellevue','Tombolia'];
    private array $profF    = ['Commerçante','Ménagère','Enseignante','Infirmière','Couturière','Secrétaire','Vendeuse','Fonctionnaire','Étudiante'];
    private array $profH    = ['Chauffeur','Commerçant','Fonctionnaire','Mécanicien','Enseignant','Ingénieur','Policier','Militaire','Agriculteur'];
    private array $groupes  = ['O+','A+','B+','O-','A-','AB+','B-','AB-'];
    private array $maternites = ['Maternité Donka','CHU Donka','Clinique Pasteur','Maternité Ignace Deen','Clinique Ambroise Paré','Centre de Santé Ratoma'];
    private array $transports = ['Taxi','Véhicule personnel','Moto','Ambulance','Taxi-moto'];
    private array $accompagnants = ['Mari','Mère','Belle-mère','Sœur','Tante'];

    public function run()
    {
        if (DB::table('patient')->exists()) {
            return;
        }

        $faker = Faker::create('fr_FR');

        $antecedentsMedicaux = [
            [3, 'Drépanocytose AS (trait dépistée en 2020)'],
            [2, 'Hypertension artérielle traitée'],
            [1, 'Diabète gestationnel lors de la grossesse précédente'],
            [4, 'Asthme léger intermittent sous Salbutamol'],
        ];

        $antecedentsChirurgicaux = [
            [5, 'Appendicectomie en 2018'],
            [6, 'Césarienne lors de la dernière grossesse'],
        ];

        $antecedentsGynecos = [
            [8, 'Avortement spontané (fausse couche précoce)'],
            [9, 'GEU traitée médicalement'],
            [10, 'Pré-éclampsie lors de la grossesse précédente'],
        ];

        for ($i = 1; $i <= 13; $i++) {
            $nom    = $faker->randomElement($this->noms);
            $prenom = $faker->randomElement($this->prenoms);
            $quartier = $faker->randomElement($this->quartiers);
            $age    = $faker->numberBetween(17, 42);
            $tel    = '6' . $faker->numberBetween(20, 29) . $faker->numerify('######');

            $idPatient = DB::table('patient')->insertGetId([
                'nom_patient'        => $nom,
                'prenom_patient'     => $prenom,
                'age_patient'        => $age,
                'adresse_patient'    => $quartier,
                'secteur_patient'    => $faker->randomElement($this->quartiers),
                'profession_patient' => $faker->randomElement($this->profF),
                'telephone_patient'  => $tel,
                'nom_mari'           => $faker->randomElement($this->noms),
                'prenom_mari'        => $faker->randomElement($this->prenomH),
                'adresse_mari'       => $quartier,
                'secteur_mari'       => $faker->randomElement($this->quartiers),
                'profession_mari'    => $faker->randomElement($this->profH),
                'telephone_mari'     => '6' . $faker->numberBetween(20, 29) . $faker->numerify('######'),
            ]);

            // Dates
            $enregistrement  = $faker->dateTimeBetween('-7 months', '-2 months');
            $derniereRegle   = (clone $enregistrement)->modify('-' . $faker->numberBetween(8, 22) . ' weeks');
            $dateAccouchement = (clone $derniereRegle)->modify('+9 months');
            $semaines        = $faker->numberBetween(8, 30);

            // Dossier d'abord (id_accouchement nullable)
            $idDossier = DB::table('dossier_patient')->insertGetId([
                'numero_dossier'      => 'CPN-' . date('Y') . '-' . str_pad($i, 3, '0', STR_PAD_LEFT),
                'date_enregistrement' => $enregistrement->format('Y-m-d'),
                'date_derniere_regle' => $derniereRegle->format('Y-m-d'),
                'dure_cycle'          => $faker->randomElement([28, 28, 28, 30, 30, 35]),
                'lieu_accouchement'   => $faker->randomElement($this->maternites),
                'date_accouchement'   => $dateAccouchement->format('Y-m-d'),
                'hadicap_pysique'     => false,
                'groupe_sanguin'      => $faker->randomElement($this->groupes),
                'taille_patiente'     => $faker->randomFloat(1, 148, 178),
                'dap'                 => $faker->randomFloat(1, 8.5, 12.5),
                'id_patient'          => $idPatient,
                'id_accouchement'     => null,
            ]);

            // Plan d'accouchement avec le vrai id_dossier
            $idAccouchement = DB::table('plan_accouchement')->insertGetId([
                'lieu_accouchement'    => $faker->randomElement($this->maternites),
                'moyens_transport'     => $faker->randomElement($this->transports),
                'personne_responsable' => $faker->randomElement($this->prenomH) . ' ' . $faker->randomElement($this->noms),
                'accompagant'          => $faker->randomElement($this->accompagnants),
                'id_dossier'           => $idDossier,
            ]);

            // Lier le plan au dossier
            DB::table('dossier_patient')->where('id_dossier', $idDossier)
                ->update(['id_accouchement' => $idAccouchement]);

            // Consultations (2 à 4)
            $nbConsult = $faker->numberBetween(2, 4);
            $dateConsult = clone $enregistrement;
            for ($j = 0; $j < $nbConsult; $j++) {
                $idConsult = DB::table('consultation')->insertGetId([
                    'date_consultation'      => $dateConsult->format('Y-m-d'),
                    'age_gestationnel'       => $semaines + ($j * 4),
                    'mouvement_percus'       => ($semaines + $j * 4) > 16 ? 1 : 0,
                    'poids'                  => $faker->randomFloat(1, 50, 90),
                    'haut_uterine'           => $semaines + ($j * 4),
                    'bruit_coeur'            => 1,
                    'conseling'              => 1,
                    'tension_arterielle'     => $faker->randomFloat(1, 10, 16),
                    'metorrhagies'           => 0,
                    'anemie_clinique'        => $faker->boolean(20) ? 1 : 0,
                    'odemes'                 => $faker->boolean(15) ? 1 : 0,
                    'infection_urinaire'     => $faker->boolean(15) ? 1 : 0,
                    'perte_fetide'           => 0,
                    'suspicion_bassin_retreci'=> 0,
                    'ca_uc_f_vada'           => 0,
                    'parite'                 => $faker->boolean(25) ? 1 : 0,
                    'primapare'              => ($i % 5 === 0) ? 1 : 0,
                    'taille'                 => 0,
                    'mn_dn_ed'               => 0,
                    'bw'                     => 0,
                    'srv'                    => 0,
                    'thb'                    => $faker->randomFloat(1, 9.0, 13.5),
                    'position_transverse'    => 0,
                    'siege'                  => $faker->boolean(5) ? 1 : 0,
                    'gemellaire'             => 0,
                    'id_dossier'             => $idDossier,
                ]);

                DB::table('consultation_agent_sante')->insert([
                    'id_agent'       => $faker->randomElement([1, 2, 3]),
                    'id_consultation' => $idConsult,
                ]);

                DB::table('consultation_produit')->insert([
                    ['id_produit' => 1, 'id_consultation' => $idConsult, 'quantite' => '60 cp'],
                    ['id_produit' => 2, 'id_consultation' => $idConsult, 'quantite' => '30 cp'],
                ]);

                $dateConsult->modify('+4 weeks');
            }

            // Gestations antérieures
            $nbAccouch = $faker->numberBetween(0, 4);
            $nbAvort   = $faker->numberBetween(0, 2);
            $nbVivants = max(0, $nbAccouch - $faker->numberBetween(0, 1));
            foreach ([
                [$nbAccouch, 1],
                [$nbAvort,   2],
                [$nbAccouch, 3],
                [max(0, $nbAccouch - $nbVivants), 4],
                [$nbVivants, 5],
                ['',         6],
            ] as [$val, $idGest]) {
                DB::table('dossier_patient_gestation')->insert([
                    'id_gestation'    => $idGest,
                    'id_dossier'      => $idDossier,
                    'valeur_gestation' => (string) $val,
                ]);
            }

            // Vaccin VAT1
            DB::table('dossier_patient_vaccin')->insert([
                'id_vaccin'        => 1,
                'id_dossier'       => $idDossier,
                'date_vaccination' => $enregistrement->format('Y-m-d'),
                'date_prochain_rdv'=> (clone $enregistrement)->modify('+4 weeks')->format('Y-m-d'),
            ]);

            // Antécédents — toutes les patientes en ont au moins un médical
            [$idAnt, $valeur] = $faker->randomElement($antecedentsMedicaux);
            DB::table('dossier_patient_antecedent')->insert([
                'id_antecedent'     => $idAnt,
                'id_dossier'        => $idDossier,
                'valeur_antecedent' => $valeur,
            ]);

            // Antécédent chirurgical (1 sur 3)
            if ($i % 3 === 0) {
                [$idAnt, $valeur] = $faker->randomElement($antecedentsChirurgicaux);
                DB::table('dossier_patient_antecedent')->insertOrIgnore([
                    'id_antecedent'     => $idAnt,
                    'id_dossier'        => $idDossier,
                    'valeur_antecedent' => $valeur,
                ]);
            }

            // Antécédent gynéco-obstétrical (1 sur 4)
            if ($i % 4 === 0) {
                [$idAnt, $valeur] = $faker->randomElement($antecedentsGynecos);
                DB::table('dossier_patient_antecedent')->insertOrIgnore([
                    'id_antecedent'     => $idAnt,
                    'id_dossier'        => $idDossier,
                    'valeur_antecedent' => $valeur,
                ]);
            }

            // Situations des enfants précédents (si multipare)
            $nbAccouch = (int) DB::table('dossier_patient_gestation')
                ->where('id_dossier', $idDossier)
                ->where('id_gestation', 1)
                ->value('valeur_gestation');

            for ($k = 1; $k <= min($nbAccouch, 3); $k++) {
                $vivant = $faker->boolean(85);
                DB::table('situation')->insert([
                    'numero'               => $k,
                    'sexe_enfant'          => $faker->randomElement(['M', 'F']),
                    'vivant'               => $vivant,
                    'age_enfant'           => $vivant ? $faker->numberBetween(1, 10) : 0,
                    'cause_deces'          => $vivant ? null : 'P',
                    'id_dossier'           => $idDossier,
                    'id_categorie_situation' => 2,
                ]);
            }

            // Rendez-vous suivant
            DB::table('rendez_vous')->insert([
                'date_rendez_vous' => (clone $enregistrement)->modify('+4 weeks')->format('Y-m-d'),
                'id_dossier'       => $idDossier,
                'date_rapel'       => (clone $enregistrement)->modify('+25 days')->format('Y-m-d'),
            ]);
        }

        $this->command->info('✅ 13 patientes créées avec dossiers, plans, consultations, antécédents, situations et rendez-vous.');
    }
}
