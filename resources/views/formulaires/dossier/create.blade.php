
<div class="card-box">
    <h4 class="header-title text-center">Ajouter un dossier</h4>
    @include('layouts.message')
    <form action="{{ route('dossiers.store') }}" method="POST">
        @csrf
       <input type="hidden" name="patient" value="{{  $patient->id_patient }}">
        <div class="form-group">
            <label for="date_derniere_regle">Date des dernières règes </label>
            <input class="form-control" type="date" name="date_derniere_regle" id="date_derniere_regle">
        </div>
        <div class="form-group">
            <label for="dure_cycle">Durée du cycle (jours)</label>
            <input class="form-control" type="number" name="dure_cycle" id="dure_cycle" min="21" max="45" placeholder="Ex : 28">
        </div>

        <p>Handicap physique</p>
        <div class="radio radio-info form-check-inline ml-1 mb-2">
            <input type="radio" id="handicap_physique_O" value="oui" name="handicap_physique" checked="">
            <label for="handicap_physique_O"> Oui </label>
        </div>
        <div class="radio radio-info form-check-inline mb-2">
            <input type="radio" id="handicap_physique_N" value="non" name="handicap_physique" checked="">
            <label for="handicap_physique_N"> Non </label>
        </div>
        <div class="form-group">
            <label for="groupe_sanguin">Groupe sanguin et Facteur Rhésus </label>
            <select name="groupe_sanguin" class="form-control" id="">
                <option value="O+">O +</option>
                <option value="A+">A +</option>
                <option value="B+">B +</option>
                <option value="O-">O -</option>
                <option value="A-">A -</option>
                <option value="AB+">AB +</option>
                <option value="B-">B -</option>
                <option value="AB-">AB -</option>
            </select>

        </div>
        <div class="form-group">
            <label for="taille_patiente">Taille de la patiente (cm)</label>
            <input class="form-control" type="number" step="0.1" name="taille_patiente" id="taille_patiente" min="100" max="220" placeholder="Ex : 162">
        </div>
        <div class="form-group">
            <label for="dap">DAP — Diamètre antéro-postérieur (cm)</label>
            <input class="form-control" type="number" step="0.1" name="dap" id="dap" min="1" max="30" placeholder="Ex : 10.5">
        </div>
        <button class="btn btn-success " type="submit">Enregistrer</button>
    </form>
</div>
