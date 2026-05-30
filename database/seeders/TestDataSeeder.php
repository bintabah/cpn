<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class TestDataSeeder extends Seeder
{
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        // ── Agents de santé supplémentaires ──────────────────────────────
        $agents = [
            ['nom' => 'Diallo',   'prenom' => 'Aissatou',   'adresse' => 'Ratoma',    'email' => 'aissatou.diallo@cpn.com',   'telephone' => '621100001', 'qualification' => 'Sage-femme',  'password' => Hash::make('password123'), 'admin' => false],
            ['nom' => 'Camara',   'prenom' => 'Ibrahima',   'adresse' => 'Dixinn',    'email' => 'ibrahima.camara@cpn.com',   'telephone' => '622200002', 'qualification' => 'Médecin',     'password' => Hash::make('password123'), 'admin' => false],
            ['nom' => 'Barry',    'prenom' => 'Fatoumata',  'adresse' => 'Matam',     'email' => 'fatoumata.barry@cpn.com',   'telephone' => '623300003', 'qualification' => 'Infirmière',  'password' => Hash::make('password123'), 'admin' => false],
        ];
        DB::table('agent_sante')->insert($agents);

        // ── Catégories d'antécédents ──────────────────────────────────────
        DB::table('categorie_antecedent')->insert([
            ['nom_cat_antecedent' => 'Médicaux'],
            ['nom_cat_antecedent' => 'Chirurgicaux'],
            ['nom_cat_antecedent' => 'Familiaux'],
            ['nom_cat_antecedent' => 'Gynéco-obstétricaux'],
        ]);

        // ── Antécédents ───────────────────────────────────────────────────
        DB::table('antecedent')->insert([
            ['nom' => 'Diabète',            'id_categorie_antecedent' => 1],
            ['nom' => 'Hypertension',       'id_categorie_antecedent' => 1],
            ['nom' => 'Drépanocytose',      'id_categorie_antecedent' => 1],
            ['nom' => 'Asthme',             'id_categorie_antecedent' => 1],
            ['nom' => 'Appendicectomie',    'id_categorie_antecedent' => 2],
            ['nom' => 'Césarienne',         'id_categorie_antecedent' => 2],
            ['nom' => 'Diabète familial',   'id_categorie_antecedent' => 3],
            ['nom' => 'Avortement',         'id_categorie_antecedent' => 4],
            ['nom' => 'GEU',                'id_categorie_antecedent' => 4],
            ['nom' => 'Pré-éclampsie',      'id_categorie_antecedent' => 4],
        ]);

        // ── Catégories de situation ───────────────────────────────────────
        DB::table('categorie_situation')->insert([
            ['nom_cat_situation' => 'G'],
            ['nom_cat_situation' => 'P'],
            ['nom_cat_situation' => 'A'],
        ]);

        // ── Gestations (types) ────────────────────────────────────────────
        DB::table('gestation')->insert([
            ['nom_gestation' => 'Grossesse unique'],
            ['nom_gestation' => 'Grossesse gémellaire'],
            ['nom_gestation' => 'Grossesse triple'],
        ]);

        // ── Vaccins ───────────────────────────────────────────────────────
        DB::table('vaccin')->insert([
            ['nom_vaccin' => 'VAT1', 'periodicite' => '4 semaines'],
            ['nom_vaccin' => 'VAT2', 'periodicite' => '4 semaines'],
            ['nom_vaccin' => 'VAT3', 'periodicite' => '6 mois'],
            ['nom_vaccin' => 'VAT4', 'periodicite' => '1 an'],
            ['nom_vaccin' => 'VAT5', 'periodicite' => '1 an'],
        ]);

        // ── Produits ──────────────────────────────────────────────────────
        DB::table('produit')->insert([
            ['nom_produit' => 'Fer'],
            ['nom_produit' => 'Acide folique'],
            ['nom_produit' => 'Mébendazole'],
            ['nom_produit' => 'Fansidar'],
            ['nom_produit' => 'Vitamine A'],
            ['nom_produit' => 'TPI (Sulfadoxine)'],
        ]);

        // ── Patients ──────────────────────────────────────────────────────
        $patients = [
            [
                'nom_patient' => 'Diallo',      'prenom_patient' => 'Mariama',
                'age_patient' => 24, 'adresse_patient' => 'Ratoma',  'secteur_patient' => 'Cosa',
                'profession_patient' => 'Commerçante',  'telephone_patient' => '624001001',
                'nom_mari' => 'Diallo',     'prenom_mari' => 'Mamadou',
                'adresse_mari' => 'Ratoma', 'secteur_mari' => 'Cosa',
                'profession_mari' => 'Chauffeur',       'telephone_mari' => '624001002',
            ],
            [
                'nom_patient' => 'Barry',       'prenom_patient' => 'Kadiatou',
                'age_patient' => 30, 'adresse_patient' => 'Dixinn',  'secteur_patient' => 'Coleah',
                'profession_patient' => 'Enseignante',  'telephone_patient' => '625002001',
                'nom_mari' => 'Barry',      'prenom_mari' => 'Alpha',
                'adresse_mari' => 'Dixinn', 'secteur_mari' => 'Coleah',
                'profession_mari' => 'Fonctionnaire',   'telephone_mari' => '625002002',
            ],
            [
                'nom_patient' => 'Bah',         'prenom_patient' => 'Fatoumata',
                'age_patient' => 19, 'adresse_patient' => 'Matam',   'secteur_patient' => 'Bellevue',
                'profession_patient' => 'Ménagère',     'telephone_patient' => '626003001',
                'nom_mari' => 'Bah',        'prenom_mari' => 'Oumar',
                'adresse_mari' => 'Matam',  'secteur_mari' => 'Bellevue',
                'profession_mari' => 'Mécanicien',      'telephone_mari' => '626003002',
            ],
            [
                'nom_patient' => 'Sow',         'prenom_patient' => 'Aissatou',
                'age_patient' => 33, 'adresse_patient' => 'Kaloum',  'secteur_patient' => 'Centre-ville',
                'profession_patient' => 'Infirmière',   'telephone_patient' => '627004001',
                'nom_mari' => 'Sow',        'prenom_mari' => 'Ibrahima',
                'adresse_mari' => 'Kaloum', 'secteur_mari' => 'Centre-ville',
                'profession_mari' => 'Ingénieur',       'telephone_mari' => '627004002',
            ],
            [
                'nom_patient' => 'Camara',      'prenom_patient' => 'Hawa',
                'age_patient' => 28, 'adresse_patient' => 'Matoto',  'secteur_patient' => 'Tombolia',
                'profession_patient' => 'Couturière',   'telephone_patient' => '628005001',
                'nom_mari' => 'Camara',     'prenom_mari' => 'Sekou',
                'adresse_mari' => 'Matoto', 'secteur_mari' => 'Tombolia',
                'profession_mari' => 'Commerçant',      'telephone_mari' => '628005002',
            ],
        ];
        DB::table('patient')->insert($patients);

        // ── Dossiers + plans d'accouchement ──────────────────────────────
        $dossiers = [
            // Mariama Diallo – G2P1, 20 SA
            ['id_patient' => 1, 'numero_dossier' => 'CPN-2024-001', 'date_enregistrement' => '2024-01-10',
             'date_derniere_regle' => '2023-10-05', 'dure_cycle' => 28,
             'lieu_accouchement' => 'Maternité Donka', 'date_accouchement' => '2024-07-12',
             'hadicap_pysique' => 0, 'groupe_sanguin' => 'O+', 'taille_patiente' => 163.0, 'dap' => 10.5, 'id_accouchement' => 1],
            // Kadiatou Barry – G3P2, 16 SA
            ['id_patient' => 2, 'numero_dossier' => 'CPN-2024-002', 'date_enregistrement' => '2024-02-05',
             'date_derniere_regle' => '2023-11-01', 'dure_cycle' => 30,
             'lieu_accouchement' => 'Clinique Pasteur', 'date_accouchement' => '2024-08-08',
             'hadicap_pysique' => 0, 'groupe_sanguin' => 'A+', 'taille_patiente' => 158.0, 'dap' => 10.0, 'id_accouchement' => 2],
            // Fatoumata Bah – G1P0, 12 SA
            ['id_patient' => 3, 'numero_dossier' => 'CPN-2024-003', 'date_enregistrement' => '2024-03-15',
             'date_derniere_regle' => '2023-12-20', 'dure_cycle' => 28,
             'lieu_accouchement' => 'Maternité Ignace Deen', 'date_accouchement' => '2024-09-27',
             'hadicap_pysique' => 0, 'groupe_sanguin' => 'B+', 'taille_patiente' => 161.0, 'dap' => 11.0, 'id_accouchement' => 3],
            // Aissatou Sow – G4P3, 28 SA
            ['id_patient' => 4, 'numero_dossier' => 'CPN-2024-004', 'date_enregistrement' => '2024-01-20',
             'date_derniere_regle' => '2023-09-15', 'dure_cycle' => 28,
             'lieu_accouchement' => 'CHU Donka', 'date_accouchement' => '2024-06-22',
             'hadicap_pysique' => 0, 'groupe_sanguin' => 'AB+', 'taille_patiente' => 165.0, 'dap' => 11.5, 'id_accouchement' => 4],
            // Hawa Camara – G2P1, 24 SA
            ['id_patient' => 5, 'numero_dossier' => 'CPN-2024-005', 'date_enregistrement' => '2024-02-28',
             'date_derniere_regle' => '2023-10-20', 'dure_cycle' => 28,
             'lieu_accouchement' => 'Maternité Donka', 'date_accouchement' => '2024-07-27',
             'hadicap_pysique' => 0, 'groupe_sanguin' => 'O-', 'taille_patiente' => 155.0, 'dap' => 9.5, 'id_accouchement' => 5],
        ];
        DB::table('dossier_patient')->insert($dossiers);

        // ── Plans d'accouchement ──────────────────────────────────────────
        $plans = [
            ['lieu_accouchement' => 'Maternité Donka',        'moyens_transport' => 'Taxi',    'personne_responsable' => 'Mamadou Diallo',   'accompagant' => 'Mère',       'id_dossier' => 1],
            ['lieu_accouchement' => 'Clinique Pasteur',       'moyens_transport' => 'Véhicule', 'personne_responsable' => 'Alpha Barry',       'accompagant' => 'Mari',       'id_dossier' => 2],
            ['lieu_accouchement' => 'Maternité Ignace Deen',  'moyens_transport' => 'Taxi',    'personne_responsable' => 'Oumar Bah',         'accompagant' => 'Tante',      'id_dossier' => 3],
            ['lieu_accouchement' => 'CHU Donka',              'moyens_transport' => 'Ambulance','personne_responsable' => 'Ibrahima Sow',      'accompagant' => 'Mari',       'id_dossier' => 4],
            ['lieu_accouchement' => 'Maternité Donka',        'moyens_transport' => 'Moto',    'personne_responsable' => 'Sekou Camara',      'accompagant' => 'Belle-mère', 'id_dossier' => 5],
        ];
        DB::table('plan_accouchement')->insert($plans);

        // ── Consultations ─────────────────────────────────────────────────
        $consultations = [
            // Dossier 1 – Mariama (3 consultations)
            ['date_consultation' => '2024-01-10', 'age_gestationnel' => 14, 'mouvement_percus' => 0, 'poids' => 62.0, 'haut_uterine' => 14.0, 'bruit_coeur' => 1, 'conseling' => 1, 'tension_arterielle' => 12.0, 'metorrhagies' => 0, 'anemie_clinique' => 0, 'odemes' => 0, 'infection_urinaire' => 0, 'perte_fetide' => 0, 'suspicion_bassin_retreci' => 0, 'ca_uc_f_vada' => 0, 'parite' => 0, 'primapare' => 0, 'taille' => 0, 'mn_dn_ed' => 0, 'bw' => 0, 'srv' => 0, 'thb' => 11.5, 'position_transverse' => 0, 'siege' => 0, 'gemellaire' => 0, 'id_dossier' => 1],
            ['date_consultation' => '2024-02-07', 'age_gestationnel' => 18, 'mouvement_percus' => 1, 'poids' => 64.5, 'haut_uterine' => 18.0, 'bruit_coeur' => 1, 'conseling' => 1, 'tension_arterielle' => 11.5, 'metorrhagies' => 0, 'anemie_clinique' => 0, 'odemes' => 0, 'infection_urinaire' => 0, 'perte_fetide' => 0, 'suspicion_bassin_retreci' => 0, 'ca_uc_f_vada' => 0, 'parite' => 0, 'primapare' => 0, 'taille' => 0, 'mn_dn_ed' => 0, 'bw' => 0, 'srv' => 0, 'thb' => 11.8, 'position_transverse' => 0, 'siege' => 0, 'gemellaire' => 0, 'id_dossier' => 1],
            ['date_consultation' => '2024-03-06', 'age_gestationnel' => 22, 'mouvement_percus' => 1, 'poids' => 66.0, 'haut_uterine' => 22.0, 'bruit_coeur' => 1, 'conseling' => 1, 'tension_arterielle' => 12.5, 'metorrhagies' => 0, 'anemie_clinique' => 0, 'odemes' => 0, 'infection_urinaire' => 0, 'perte_fetide' => 0, 'suspicion_bassin_retreci' => 0, 'ca_uc_f_vada' => 0, 'parite' => 0, 'primapare' => 0, 'taille' => 0, 'mn_dn_ed' => 0, 'bw' => 0, 'srv' => 0, 'thb' => 12.0, 'position_transverse' => 0, 'siege' => 0, 'gemellaire' => 0, 'id_dossier' => 1],
            // Dossier 2 – Kadiatou (2 consultations)
            ['date_consultation' => '2024-02-05', 'age_gestationnel' => 16, 'mouvement_percus' => 1, 'poids' => 70.0, 'haut_uterine' => 16.0, 'bruit_coeur' => 1, 'conseling' => 1, 'tension_arterielle' => 13.0, 'metorrhagies' => 0, 'anemie_clinique' => 0, 'odemes' => 1, 'infection_urinaire' => 0, 'perte_fetide' => 0, 'suspicion_bassin_retreci' => 0, 'ca_uc_f_vada' => 0, 'parite' => 0, 'primapare' => 0, 'taille' => 0, 'mn_dn_ed' => 0, 'bw' => 0, 'srv' => 0, 'thb' => 10.8, 'position_transverse' => 0, 'siege' => 0, 'gemellaire' => 0, 'id_dossier' => 2],
            ['date_consultation' => '2024-03-05', 'age_gestationnel' => 20, 'mouvement_percus' => 1, 'poids' => 72.0, 'haut_uterine' => 20.0, 'bruit_coeur' => 1, 'conseling' => 1, 'tension_arterielle' => 13.5, 'metorrhagies' => 0, 'anemie_clinique' => 1, 'odemes' => 1, 'infection_urinaire' => 0, 'perte_fetide' => 0, 'suspicion_bassin_retreci' => 0, 'ca_uc_f_vada' => 0, 'parite' => 0, 'primapare' => 0, 'taille' => 0, 'mn_dn_ed' => 0, 'bw' => 0, 'srv' => 0, 'thb' => 10.2, 'position_transverse' => 0, 'siege' => 0, 'gemellaire' => 0, 'id_dossier' => 2],
            // Dossier 3 – Fatoumata (2 consultations)
            ['date_consultation' => '2024-03-15', 'age_gestationnel' => 12, 'mouvement_percus' => 0, 'poids' => 58.0, 'haut_uterine' => 12.0, 'bruit_coeur' => 1, 'conseling' => 1, 'tension_arterielle' => 11.0, 'metorrhagies' => 0, 'anemie_clinique' => 0, 'odemes' => 0, 'infection_urinaire' => 1, 'perte_fetide' => 0, 'suspicion_bassin_retreci' => 0, 'ca_uc_f_vada' => 0, 'parite' => 0, 'primapare' => 1, 'taille' => 0, 'mn_dn_ed' => 0, 'bw' => 0, 'srv' => 0, 'thb' => 11.0, 'position_transverse' => 0, 'siege' => 0, 'gemellaire' => 0, 'id_dossier' => 3],
            ['date_consultation' => '2024-04-12', 'age_gestationnel' => 16, 'mouvement_percus' => 1, 'poids' => 59.5, 'haut_uterine' => 16.0, 'bruit_coeur' => 1, 'conseling' => 1, 'tension_arterielle' => 11.5, 'metorrhagies' => 0, 'anemie_clinique' => 0, 'odemes' => 0, 'infection_urinaire' => 0, 'perte_fetide' => 0, 'suspicion_bassin_retreci' => 0, 'ca_uc_f_vada' => 0, 'parite' => 0, 'primapare' => 1, 'taille' => 0, 'mn_dn_ed' => 0, 'bw' => 0, 'srv' => 0, 'thb' => 11.5, 'position_transverse' => 0, 'siege' => 0, 'gemellaire' => 0, 'id_dossier' => 3],
            // Dossier 4 – Aissatou (3 consultations)
            ['date_consultation' => '2024-01-20', 'age_gestationnel' => 18, 'mouvement_percus' => 1, 'poids' => 78.0, 'haut_uterine' => 18.0, 'bruit_coeur' => 1, 'conseling' => 1, 'tension_arterielle' => 14.0, 'metorrhagies' => 0, 'anemie_clinique' => 0, 'odemes' => 1, 'infection_urinaire' => 0, 'perte_fetide' => 0, 'suspicion_bassin_retreci' => 0, 'ca_uc_f_vada' => 0, 'parite' => 1, 'primapare' => 0, 'taille' => 0, 'mn_dn_ed' => 0, 'bw' => 0, 'srv' => 0, 'thb' => 10.5, 'position_transverse' => 0, 'siege' => 0, 'gemellaire' => 0, 'id_dossier' => 4],
            ['date_consultation' => '2024-02-17', 'age_gestationnel' => 22, 'mouvement_percus' => 1, 'poids' => 80.5, 'haut_uterine' => 22.0, 'bruit_coeur' => 1, 'conseling' => 1, 'tension_arterielle' => 14.5, 'metorrhagies' => 0, 'anemie_clinique' => 1, 'odemes' => 1, 'infection_urinaire' => 0, 'perte_fetide' => 0, 'suspicion_bassin_retreci' => 0, 'ca_uc_f_vada' => 0, 'parite' => 1, 'primapare' => 0, 'taille' => 0, 'mn_dn_ed' => 0, 'bw' => 0, 'srv' => 0, 'thb' => 9.8,  'position_transverse' => 0, 'siege' => 0, 'gemellaire' => 0, 'id_dossier' => 4],
            ['date_consultation' => '2024-03-16', 'age_gestationnel' => 26, 'mouvement_percus' => 1, 'poids' => 82.0, 'haut_uterine' => 26.0, 'bruit_coeur' => 1, 'conseling' => 1, 'tension_arterielle' => 15.0, 'metorrhagies' => 0, 'anemie_clinique' => 1, 'odemes' => 1, 'infection_urinaire' => 0, 'perte_fetide' => 0, 'suspicion_bassin_retreci' => 0, 'ca_uc_f_vada' => 0, 'parite' => 1, 'primapare' => 0, 'taille' => 0, 'mn_dn_ed' => 0, 'bw' => 0, 'srv' => 0, 'thb' => 9.5,  'position_transverse' => 0, 'siege' => 0, 'gemellaire' => 0, 'id_dossier' => 4],
            // Dossier 5 – Hawa (2 consultations)
            ['date_consultation' => '2024-02-28', 'age_gestationnel' => 20, 'mouvement_percus' => 1, 'poids' => 55.0, 'haut_uterine' => 20.0, 'bruit_coeur' => 1, 'conseling' => 1, 'tension_arterielle' => 11.0, 'metorrhagies' => 0, 'anemie_clinique' => 0, 'odemes' => 0, 'infection_urinaire' => 0, 'perte_fetide' => 0, 'suspicion_bassin_retreci' => 0, 'ca_uc_f_vada' => 0, 'parite' => 0, 'primapare' => 0, 'taille' => 0, 'mn_dn_ed' => 0, 'bw' => 0, 'srv' => 0, 'thb' => 12.1, 'position_transverse' => 0, 'siege' => 0, 'gemellaire' => 0, 'id_dossier' => 5],
            ['date_consultation' => '2024-03-28', 'age_gestationnel' => 24, 'mouvement_percus' => 1, 'poids' => 57.0, 'haut_uterine' => 24.0, 'bruit_coeur' => 1, 'conseling' => 1, 'tension_arterielle' => 11.5, 'metorrhagies' => 0, 'anemie_clinique' => 0, 'odemes' => 0, 'infection_urinaire' => 0, 'perte_fetide' => 0, 'suspicion_bassin_retreci' => 0, 'ca_uc_f_vada' => 0, 'parite' => 0, 'primapare' => 0, 'taille' => 0, 'mn_dn_ed' => 0, 'bw' => 0, 'srv' => 0, 'thb' => 12.3, 'position_transverse' => 0, 'siege' => 0, 'gemellaire' => 0, 'id_dossier' => 5],
        ];
        DB::table('consultation')->insert($consultations);

        // ── Consultations ↔ Agents ────────────────────────────────────────
        // agent 1 = Admin (id=1), agent 2 = Aissatou (id=2), agent 3 = Ibrahima (id=3)
        DB::table('consultation_agent_sante')->insert([
            ['id_agent' => 1, 'id_consultation' => 1],
            ['id_agent' => 2, 'id_consultation' => 1],
            ['id_agent' => 2, 'id_consultation' => 2],
            ['id_agent' => 1, 'id_consultation' => 3],
            ['id_agent' => 3, 'id_consultation' => 4],
            ['id_agent' => 3, 'id_consultation' => 5],
            ['id_agent' => 2, 'id_consultation' => 6],
            ['id_agent' => 2, 'id_consultation' => 7],
            ['id_agent' => 1, 'id_consultation' => 8],
            ['id_agent' => 3, 'id_consultation' => 9],
            ['id_agent' => 1, 'id_consultation' => 10],
            ['id_agent' => 2, 'id_consultation' => 11],
            ['id_agent' => 2, 'id_consultation' => 12],
        ]);

        // ── Consultations ↔ Produits ──────────────────────────────────────
        DB::table('consultation_produit')->insert([
            ['id_produit' => 1, 'id_consultation' => 1,  'quantite' => '60 cp'],
            ['id_produit' => 2, 'id_consultation' => 1,  'quantite' => '30 cp'],
            ['id_produit' => 4, 'id_consultation' => 1,  'quantite' => '3 cp'],
            ['id_produit' => 1, 'id_consultation' => 2,  'quantite' => '60 cp'],
            ['id_produit' => 3, 'id_consultation' => 2,  'quantite' => '1 cp'],
            ['id_produit' => 1, 'id_consultation' => 3,  'quantite' => '60 cp'],
            ['id_produit' => 1, 'id_consultation' => 4,  'quantite' => '60 cp'],
            ['id_produit' => 2, 'id_consultation' => 4,  'quantite' => '30 cp'],
            ['id_produit' => 1, 'id_consultation' => 5,  'quantite' => '60 cp'],
            ['id_produit' => 5, 'id_consultation' => 5,  'quantite' => '1 cp'],
            ['id_produit' => 1, 'id_consultation' => 6,  'quantite' => '60 cp'],
            ['id_produit' => 2, 'id_consultation' => 6,  'quantite' => '30 cp'],
            ['id_produit' => 1, 'id_consultation' => 8,  'quantite' => '60 cp'],
            ['id_produit' => 6, 'id_consultation' => 8,  'quantite' => '3 cp'],
            ['id_produit' => 1, 'id_consultation' => 11, 'quantite' => '60 cp'],
            ['id_produit' => 2, 'id_consultation' => 11, 'quantite' => '30 cp'],
        ]);

        // ── Vaccinations ──────────────────────────────────────────────────
        DB::table('dossier_patient_vaccin')->insert([
            ['id_vaccin' => 1, 'id_dossier' => 1, 'date_vaccination' => '2024-01-10', 'date_prochain_rdv' => '2024-02-07'],
            ['id_vaccin' => 2, 'id_dossier' => 1, 'date_vaccination' => '2024-02-07', 'date_prochain_rdv' => '2024-08-07'],
            ['id_vaccin' => 1, 'id_dossier' => 2, 'date_vaccination' => '2024-02-05', 'date_prochain_rdv' => '2024-03-05'],
            ['id_vaccin' => 2, 'id_dossier' => 2, 'date_vaccination' => '2024-03-05', 'date_prochain_rdv' => '2024-09-05'],
            ['id_vaccin' => 1, 'id_dossier' => 3, 'date_vaccination' => '2024-03-15', 'date_prochain_rdv' => '2024-04-12'],
            ['id_vaccin' => 1, 'id_dossier' => 4, 'date_vaccination' => '2024-01-20', 'date_prochain_rdv' => '2024-02-17'],
            ['id_vaccin' => 2, 'id_dossier' => 4, 'date_vaccination' => '2024-02-17', 'date_prochain_rdv' => '2024-08-17'],
            ['id_vaccin' => 1, 'id_dossier' => 5, 'date_vaccination' => '2024-02-28', 'date_prochain_rdv' => '2024-03-28'],
        ]);

        // ── Gestations des dossiers ───────────────────────────────────────
        DB::table('dossier_patient_gestation')->insert([
            ['id_gestation' => 1, 'id_dossier' => 1, 'valeur_gestation' => 'G2'],
            ['id_gestation' => 1, 'id_dossier' => 2, 'valeur_gestation' => 'G3'],
            ['id_gestation' => 1, 'id_dossier' => 3, 'valeur_gestation' => 'G1'],
            ['id_gestation' => 1, 'id_dossier' => 4, 'valeur_gestation' => 'G4'],
            ['id_gestation' => 1, 'id_dossier' => 5, 'valeur_gestation' => 'G2'],
        ]);

        // ── Antécédents des dossiers ──────────────────────────────────────
        DB::table('dossier_patient_antecedent')->insert([
            ['id_antecedent' => 6, 'id_dossier' => 2, 'valeur_antecedent' => 'Césarienne 2021'],
            ['id_antecedent' => 2, 'id_dossier' => 4, 'valeur_antecedent' => 'HTA depuis 2019'],
            ['id_antecedent' => 6, 'id_dossier' => 4, 'valeur_antecedent' => 'Césarienne 2020'],
            ['id_antecedent' => 8, 'id_dossier' => 4, 'valeur_antecedent' => 'Avortement 2018'],
        ]);

        // ── Situations obstétricales ──────────────────────────────────────
        DB::table('situation')->insert([
            // Mariama G2 : 1 enfant vivant
            ['numero' => 1, 'sexe_enfant' => 'M', 'vivant' => 1, 'age_enfant' => 2, 'cause_deces' => null, 'id_dossier' => 1, 'id_categorie_situation' => 2],
            // Kadiatou G3P2 : 2 enfants vivants
            ['numero' => 1, 'sexe_enfant' => 'F', 'vivant' => 1, 'age_enfant' => 5, 'cause_deces' => null, 'id_dossier' => 2, 'id_categorie_situation' => 2],
            ['numero' => 2, 'sexe_enfant' => 'M', 'vivant' => 1, 'age_enfant' => 3, 'cause_deces' => null, 'id_dossier' => 2, 'id_categorie_situation' => 2],
            // Aissatou G4P3 : 2 vivants, 1 décédé
            ['numero' => 1, 'sexe_enfant' => 'M', 'vivant' => 1, 'age_enfant' => 8, 'cause_deces' => null, 'id_dossier' => 4, 'id_categorie_situation' => 2],
            ['numero' => 2, 'sexe_enfant' => 'F', 'vivant' => 0, 'age_enfant' => 0, 'cause_deces' => 'P', 'id_dossier' => 4, 'id_categorie_situation' => 2],
            ['numero' => 3, 'sexe_enfant' => 'F', 'vivant' => 1, 'age_enfant' => 4, 'cause_deces' => null, 'id_dossier' => 4, 'id_categorie_situation' => 2],
            // Hawa G2P1 : 1 enfant vivant
            ['numero' => 1, 'sexe_enfant' => 'M', 'vivant' => 1, 'age_enfant' => 3, 'cause_deces' => null, 'id_dossier' => 5, 'id_categorie_situation' => 2],
        ]);

        // ── Rendez-vous ───────────────────────────────────────────────────
        DB::table('rendez_vous')->insert([
            ['date_rendez_vous' => '2024-04-03',  'id_dossier' => 1, 'date_rapel' => '2024-04-01'],
            ['date_rendez_vous' => '2024-05-01',  'id_dossier' => 1, 'date_rapel' => '2024-04-29'],
            ['date_rendez_vous' => '2024-04-02',  'id_dossier' => 2, 'date_rapel' => '2024-03-31'],
            ['date_rendez_vous' => '2024-05-01',  'id_dossier' => 2, 'date_rapel' => '2024-04-29'],
            ['date_rendez_vous' => '2024-05-10',  'id_dossier' => 3, 'date_rapel' => '2024-05-08'],
            ['date_rendez_vous' => '2024-04-13',  'id_dossier' => 4, 'date_rapel' => '2024-04-11'],
            ['date_rendez_vous' => '2024-04-25',  'id_dossier' => 5, 'date_rapel' => '2024-04-23'],
        ]);

        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        $this->command->info('✅ Données de test insérées avec succès !');
        $this->command->info('   - 3 agents de santé supplémentaires');
        $this->command->info('   - 5 patientes avec leurs dossiers complets');
        $this->command->info('   - 12 consultations avec produits et agents');
        $this->command->info('   - Vaccinations, antécédents, rendez-vous');
    }
}
