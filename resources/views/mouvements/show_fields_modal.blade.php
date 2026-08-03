<p class="pull-right">
<strong><u id="entete"></u></strong>
<form action="{{route('mouvements.store')}}" method="post">
    @csrf()
    @if(Auth::user()->isAdmin())
    <div class="row mt-1">
        <div class="col-sm-1"></div>
        <div class="col-md-4">
            CENTRE DE SELECTION
        </div>
        <div class="col-md-6">
            <select name="selection" id="selection" class="form-control select2" required>
                <option value="">DEFINIR LE CENTRE DE SELECTION</option>
                @foreach($selections as $selection)
                    <option value="{{$selection->centre}}" {{isset($mouvement) && $mouvement->$selection == $selection->centre ? 'selected' : ''}}>{{$selection->centre}}</option>
                @endforeach
            </select>
        </div>
    </div>
    @endif
    <div class="row mt-1">
        <div class="col-sm-1"></div>
        <div class="col-md-4">
            CENTRE DE FORMATION
        </div>
        <div class="col-md-6">
            <select name="formation" id="formation" class="form-control select2" required>
                <option value="">DEFINIR LE CENTRE DE FORMATION</option>
                @foreach($centres as $centre)
                    <option value="{{$centre->centre}}">{{$centre->centre}}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="row mt-1">
        <div class="col-sm-1"></div>
        <div class="col-md-4">
             MOYEN DE TRANSPORT
        </div>
        <div class="col-md-6">
            <select name="moyen" id="moyenTr" class="form-control col-sm-6 select2" required>
                <option value="">DEFINIR LE MOYEN UTILISE</option>
                <option value="CAR">CAR SNTL</option>
                <option value="MO/FAR">MOYEN MILITAIRE</option>
                <option value="BON">BON MODEL 8</option>
            </select>
        </div>
    </div>
    <!-- Div pour le prix -->
<div class="row mt-1" id="prix_div" style="display: none;">
    <div class="col-sm-1"></div>
    <div class="col-md-4">
         PRIX
    </div>
    <div class="col-md-6">
        <input type="number" name="prix" id="prix" step="any" class="form-control col-sm-6" placeholder="Entrez le prix">
    </div>
</div>

<!-- Div pour le select des 3 choix pour MOYEN MILITAIRE -->
<div class="row mt-1" id="militaire_div" style="display: none;">
    <div class="col-sm-1"></div>
    <div class="col-md-4">
         OPTIONS MOYEN MILITAIRE
    </div>
    <div class="col-md-6">
        <select name="option_moyen" id="option_moyen" class="form-control col-sm-6 select2">
            <option value="">Choisir une option</option>
            <option value="GT">Moyen GT</option>
            <option value="MARINE">I.Marine</option>
            <option value="FRA">I.Fra</option>
        </select>
    </div>
</div>
    <div class="row mt-1">
        <div class="col-sm-1"></div>
        <div class="col-md-4">
            NOMBRE DE MOYEN
        </div>
        <div class="col-md-6">
            <input name="nombre" type="number" id="nombre" value="" class="form-control" required>
        </div>
    </div>
    <div class="row mt-1">
        <div class="col-sm-1"></div>
        <div class="col-md-4">
            EFFECTIF
        </div>
        <div class="col-md-6">
            <input name="effectif" type="number" id="effectif" value="" class="form-control" required>
        </div>
    </div>

    <div class="row mt-1">
        <div class="col-sm-1"></div>
        <div class="col-md-4">
            DATE DE TRANSPORT
        </div>
        <div class="col-md-6">
            <input name="depart" type="datetime-local" id="depart" value="" class="form-control" required>
        </div>
{{--        <div class="col-md-2">--}}
{{--            <input name="time" type="time" id="time" value="" class="form-control" required>--}}
{{--        </div>--}}
    </div>

    <div class="row mt-1">
        <div class="col-sm-1"></div>
        <div class="col-md-4">
            DATE ET HEURE D'ARRIVEE
        </div>
        <div class="col-md-6">
            <input name="arrivee" type="datetime-local" id="arrivee" value="" class="form-control">
        </div>
{{--        <div class="col-md-2">--}}
{{--            <input name="time_arrivee" type="time" id="time_arrivee" value="" class="form-control" required>--}}
{{--        </div>--}}
    </div>

    <input type="submit" class="btn btn-success pull-right" value="Enregistrer">
</form>

