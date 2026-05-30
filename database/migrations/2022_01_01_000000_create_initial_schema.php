<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('categorie_antecedent', function (Blueprint $table) {
            $table->increments('id_categorie_antecedent');
            $table->string('nom_cat_antecedent', 50);
        });

        Schema::create('antecedent', function (Blueprint $table) {
            $table->increments('id_antecedent');
            $table->string('nom', 50);
            $table->unsignedInteger('id_categorie_antecedent');
            $table->foreign('id_categorie_antecedent')->references('id_categorie_antecedent')->on('categorie_antecedent');
        });

        Schema::create('categorie_situation', function (Blueprint $table) {
            $table->increments('id_categorie_situation');
            $table->string('nom_cat_situation', 50);
        });

        Schema::create('gestation', function (Blueprint $table) {
            $table->increments('id_gestation');
            $table->string('nom_gestation', 50);
        });

        Schema::create('vaccin', function (Blueprint $table) {
            $table->increments('id_vaccin');
            $table->string('nom_vaccin', 10);
            $table->string('periodicite', 10);
        });

        Schema::create('produit', function (Blueprint $table) {
            $table->increments('id_produit');
            $table->string('nom_produit', 50);
        });

        Schema::create('agent_sante', function (Blueprint $table) {
            $table->increments('id_agent');
            $table->string('nom', 50);
            $table->string('prenom', 150);
            $table->string('adresse', 80);
            $table->string('email', 80)->unique();
            $table->string('telephone', 20);
            $table->string('qualification', 80);
            $table->string('password', 255);
            $table->boolean('admin')->default(false);
            $table->rememberToken();
        });

        Schema::create('patient', function (Blueprint $table) {
            $table->increments('id_patient');
            $table->string('nom_patient', 50);
            $table->string('prenom_patient', 150);
            $table->integer('age_patient')->nullable();
            $table->string('adresse_patient', 50);
            $table->string('secteur_patient', 150);
            $table->string('profession_patient', 50);
            $table->string('telephone_patient', 20);
            $table->string('nom_mari', 50)->nullable();
            $table->string('prenom_mari', 150)->nullable();
            $table->string('adresse_mari', 50)->nullable();
            $table->string('secteur_mari', 50)->nullable();
            $table->string('profession_mari', 50)->nullable();
            $table->string('telephone_mari', 20)->nullable();
        });

        // plan_accouchement créé AVANT dossier_patient (FK circulaire)
        // id_dossier ajouté après la création de dossier_patient
        Schema::create('plan_accouchement', function (Blueprint $table) {
            $table->increments('id_accouchement');
            $table->string('lieu_accouchement', 100);
            $table->string('moyens_transport', 50);
            $table->string('personne_responsable', 50);
            $table->string('accompagant', 50);
            $table->unsignedInteger('id_dossier')->default(0);
        });

        Schema::create('dossier_patient', function (Blueprint $table) {
            $table->increments('id_dossier');
            $table->string('numero_dossier', 20);
            $table->date('date_enregistrement');
            $table->date('date_derniere_regle')->nullable();
            $table->integer('dure_cycle')->nullable();
            $table->string('lieu_accouchement', 50);
            $table->date('date_accouchement')->nullable();
            $table->boolean('hadicap_pysique');
            $table->string('groupe_sanguin', 5);
            $table->float('taille_patiente');
            $table->float('dap');
            $table->unsignedInteger('id_patient');
            $table->unsignedInteger('id_accouchement')->nullable();
            $table->foreign('id_patient')->references('id_patient')->on('patient');
            $table->foreign('id_accouchement')->references('id_accouchement')->on('plan_accouchement');
        });

        // Ajouter la FK plan_accouchement → dossier_patient maintenant que dossier existe
        Schema::table('plan_accouchement', function (Blueprint $table) {
            $table->foreign('id_dossier')->references('id_dossier')->on('dossier_patient');
        });

        Schema::create('dossier_patient_antecedent', function (Blueprint $table) {
            $table->unsignedInteger('id_antecedent');
            $table->unsignedInteger('id_dossier');
            $table->string('valeur_antecedent', 50);
            $table->primary(['id_antecedent', 'id_dossier']);
            $table->foreign('id_antecedent')->references('id_antecedent')->on('antecedent');
            $table->foreign('id_dossier')->references('id_dossier')->on('dossier_patient');
        });

        Schema::create('dossier_patient_gestation', function (Blueprint $table) {
            $table->unsignedInteger('id_gestation');
            $table->unsignedInteger('id_dossier');
            $table->string('valeur_gestation', 200);
            $table->primary(['id_gestation', 'id_dossier']);
            $table->foreign('id_gestation')->references('id_gestation')->on('gestation');
            $table->foreign('id_dossier')->references('id_dossier')->on('dossier_patient');
        });

        Schema::create('dossier_patient_vaccin', function (Blueprint $table) {
            $table->unsignedInteger('id_vaccin');
            $table->unsignedInteger('id_dossier');
            $table->date('date_vaccination');
            $table->date('date_prochain_rdv');
            $table->primary(['id_vaccin', 'id_dossier']);
            $table->foreign('id_vaccin')->references('id_vaccin')->on('vaccin');
            $table->foreign('id_dossier')->references('id_dossier')->on('dossier_patient');
        });

        Schema::create('situation', function (Blueprint $table) {
            $table->increments('id_situattion');
            $table->integer('numero');
            $table->string('sexe_enfant', 2);
            $table->boolean('vivant');
            $table->integer('age_enfant');
            $table->string('cause_deces', 2)->nullable();
            $table->unsignedInteger('id_dossier');
            $table->unsignedInteger('id_categorie_situation');
            $table->foreign('id_dossier')->references('id_dossier')->on('dossier_patient');
            $table->foreign('id_categorie_situation')->references('id_categorie_situation')->on('categorie_situation');
        });

        Schema::create('consultation', function (Blueprint $table) {
            $table->increments('id_consultation');
            $table->date('date_consultation');
            $table->integer('age_gestationnel');
            $table->boolean('mouvement_percus');
            $table->float('poids');
            $table->float('haut_uterine');
            $table->boolean('bruit_coeur');
            $table->boolean('conseling')->nullable();
            $table->float('tension_arterielle');
            $table->boolean('metorrhagies');
            $table->boolean('anemie_clinique');
            $table->boolean('odemes');
            $table->boolean('infection_urinaire');
            $table->boolean('perte_fetide');
            $table->boolean('suspicion_bassin_retreci')->nullable();
            $table->boolean('ca_uc_f_vada')->nullable();
            $table->boolean('parite')->nullable();
            $table->boolean('primapare')->nullable();
            $table->boolean('taille')->nullable();
            $table->boolean('mn_dn_ed')->nullable();
            $table->boolean('bw')->nullable();
            $table->boolean('srv')->nullable();
            $table->float('thb')->nullable();
            $table->boolean('position_transverse')->nullable();
            $table->boolean('siege')->nullable();
            $table->boolean('gemellaire')->nullable();
            $table->unsignedInteger('id_dossier');
            $table->foreign('id_dossier')->references('id_dossier')->on('dossier_patient');
        });

        Schema::create('consultation_agent_sante', function (Blueprint $table) {
            $table->unsignedInteger('id_agent');
            $table->unsignedInteger('id_consultation');
            $table->primary(['id_agent', 'id_consultation']);
            $table->foreign('id_agent')->references('id_agent')->on('agent_sante');
            $table->foreign('id_consultation')->references('id_consultation')->on('consultation');
        });

        Schema::create('consultation_produit', function (Blueprint $table) {
            $table->unsignedInteger('id_produit');
            $table->unsignedInteger('id_consultation');
            $table->string('quantite')->nullable();
            $table->primary(['id_produit', 'id_consultation']);
            $table->foreign('id_produit')->references('id_produit')->on('produit');
            $table->foreign('id_consultation')->references('id_consultation')->on('consultation');
        });

        Schema::create('transfert', function (Blueprint $table) {
            $table->increments('id_transfert');
            $table->date('date_transfert');
            $table->boolean('cpc')->nullable();
            $table->boolean('reference_immediate')->nullable();
            $table->text('cpc_traitement');
            $table->unsignedInteger('id_consultation');
            $table->foreign('id_consultation')->references('id_consultation')->on('consultation');
        });
    }

    public function down()
    {
        Schema::dropIfExists('transfert');
        Schema::dropIfExists('consultation_produit');
        Schema::dropIfExists('consultation_agent_sante');
        Schema::dropIfExists('consultation');
        Schema::dropIfExists('situation');
        Schema::dropIfExists('dossier_patient_vaccin');
        Schema::dropIfExists('dossier_patient_gestation');
        Schema::dropIfExists('dossier_patient_antecedent');
        Schema::table('plan_accouchement', fn($t) => $t->dropForeign(['id_dossier']));
        Schema::dropIfExists('dossier_patient');
        Schema::dropIfExists('plan_accouchement');
        Schema::dropIfExists('patient');
        Schema::dropIfExists('agent_sante');
        Schema::dropIfExists('produit');
        Schema::dropIfExists('vaccin');
        Schema::dropIfExists('gestation');
        Schema::dropIfExists('categorie_situation');
        Schema::dropIfExists('antecedent');
        Schema::dropIfExists('categorie_antecedent');
    }
};
