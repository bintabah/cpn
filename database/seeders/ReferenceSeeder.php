<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ReferenceSeeder extends Seeder
{
    public function run()
    {
        DB::table('categorie_antecedent')->insertOrIgnore([
            ['nom_cat_antecedent' => 'Médicaux'],
            ['nom_cat_antecedent' => 'Chirurgicaux'],
            ['nom_cat_antecedent' => 'Familiaux'],
            ['nom_cat_antecedent' => 'Gynéco-obstétricaux'],
        ]);

        DB::table('antecedent')->insertOrIgnore([
            ['nom' => 'Diabète',          'id_categorie_antecedent' => 1],
            ['nom' => 'Hypertension',     'id_categorie_antecedent' => 1],
            ['nom' => 'Drépanocytose',    'id_categorie_antecedent' => 1],
            ['nom' => 'Asthme',           'id_categorie_antecedent' => 1],
            ['nom' => 'Appendicectomie',  'id_categorie_antecedent' => 2],
            ['nom' => 'Césarienne',       'id_categorie_antecedent' => 2],
            ['nom' => 'Diabète familial', 'id_categorie_antecedent' => 3],
            ['nom' => 'Avortement',       'id_categorie_antecedent' => 4],
            ['nom' => 'GEU',              'id_categorie_antecedent' => 4],
            ['nom' => 'Pré-éclampsie',    'id_categorie_antecedent' => 4],
        ]);

        DB::table('categorie_situation')->insertOrIgnore([
            ['nom_cat_situation' => 'G'],
            ['nom_cat_situation' => 'P'],
            ['nom_cat_situation' => 'A'],
        ]);

        DB::table('gestation')->insertOrIgnore([
            ['nom_gestation' => "Nombre d'accouchements(parite)"],
            ['nom_gestation' => "Nombre d'avortements"],
            ['nom_gestation' => "Nombre total d'enfants nés-vivants"],
            ['nom_gestation' => "Enfants mort-nés"],
            ['nom_gestation' => "A ce jour nombre total d'enfants vivants"],
            ['nom_gestation' => "Observations"],
        ]);

        DB::table('vaccin')->insertOrIgnore([
            ['nom_vaccin' => 'VAT1', 'periodicite' => '4 semaines'],
            ['nom_vaccin' => 'VAT2', 'periodicite' => '4 semaines'],
            ['nom_vaccin' => 'VAT3', 'periodicite' => '6 mois'],
            ['nom_vaccin' => 'VAT4', 'periodicite' => '1 an'],
            ['nom_vaccin' => 'VAT5', 'periodicite' => '1 an'],
        ]);

        DB::table('produit')->insertOrIgnore([
            ['nom_produit' => 'Fer'],
            ['nom_produit' => 'Acide folique'],
            ['nom_produit' => 'Mébendazole'],
            ['nom_produit' => 'Fansidar'],
            ['nom_produit' => 'Vitamine A'],
            ['nom_produit' => 'TPI (Sulfadoxine)'],
        ]);
    }
}
