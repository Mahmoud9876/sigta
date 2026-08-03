<p class="pull-right">
    <strong><u id="entete"></u></strong>
<form action="{{route('mouvements.update', $mouvement->id)}}" method="post">
    @method('put')
    @csrf()
    @if(Auth::user()->isAdmin())
    <div class="row mt-1">
        <div class="col-sm-1"></div>
        <div class="col-md-4">
            CENTRE DE SELECTION
        </div>
        <div class="col-md-6">
            <select name="selection" id="selection" class="form-control select2" autocomplete="off" required>
                <option value="">DEFINIR LE CENTRE DE SELECTION</option>
                @foreach($selections as $selection)
                    <option value="{{$selection->centre}}" {{$mouvement->selection == $selection->centre ? 'selected="selected"' : ''}}>{{$selection->centre}}</option>
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
            <select name="formation" id="formation" class="form-control select2" autocomplete="off" required>
                <option value="">DEFINIR LE CENTRE DE FORMATION</option>
                @foreach($centres as $centre)
                    <option value="{{$centre->centre}}" {{$mouvement->formation == $centre->centre ? 'selected' : ''}}>{{$centre->centre}}</option>
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
            <select name="moyen" id="moyenEdit-{{$mouvement->id}}" class="form-control col-sm-6 select2" autocomplete="off" required>
                <option value="">DEFINIR LE MOYEN UTILISE</option>
                <option value="CAR" {{$mouvement->moyen == 'CAR' ? 'selected' : ''}}>CAR SNTL</option>
                <option value="MO/FAR" {{$mouvement->moyen == 'MO/FAR' ? 'selected' : ''}}>MOYEN MILITAIRE</option>
                <option value="BON" {{$mouvement->moyen == 'BON' ? 'selected' : ''}}>BON MODEL 8</option>
            </select>
        </div>
    </div>
    <div class="row mt-1" id="prix_div_edit-{{$mouvement->id}}" style="display: none;">
        <div class="col-sm-1"></div>
        <div class="col-md-4">
            PRIX
        </div>
        <div class="col-md-6">
            <input name="prix" type="number" id="prix_edit-{{$mouvement->id}}"  step="any"
             value="{{$mouvement->prix}}" class="form-control"   >
        </div>
    </div>
    <div class="row mt-1" id="militaire_div_edit-{{$mouvement->id}}" style="display: none;">
        <div class="col-sm-1"></div>
        <div class="col-md-4">
             OPTIONS MOYEN MILITAIRE
        </div>
        <div class="col-md-6">
            <select name="option_moyen" id="option_moyen_edit" class="form-control col-sm-6 select2" autocomplete="off" >
                <option value="">Choisir une option</option>
                <option value="GT" {{$mouvement->option_moyen == 'GT' ? 'selected' : ''}}>GT</option>
                <option value="MARINE" {{$mouvement->option_moyen == 'MARINE' ? 'selected' : ''}}>MARINE</option>
                <option value="FRA" {{$mouvement->option_moyen == 'FRA' ? 'selected' : ''}}>FRA</option>

            </select>
        </div>
    </div>
    <div class="row mt-1">
        <div class="col-sm-1"></div>
        <div class="col-md-4">
            NOMBRE DE MOYEN
        </div>
        <div class="col-md-6">
            <input name="nombre" type="number" id="nombre" value="{{$mouvement->nombre}}" class="form-control" required>
        </div>
    </div>
    <div class="row mt-1">
        <div class="col-sm-1"></div>
        <div class="col-md-4">
            EFFECTIF
        </div>
        <div class="col-md-6">
            <input name="effectif" type="number" id="effectif" value="{{$mouvement->effectif}}" class="form-control" required>
        </div>
    </div>

    <div class="row mt-1">
        <div class="col-sm-1"></div>
        <div class="col-md-4">
            DATE ET HEURE DE TRANSPORT <span class="alert">(AM: entre 00:00 à 12:00 PM: entre 12:01 à 23:59)</span>
        </div>
        <div class="col-md-6">
            <input name="depart" type="datetime-local" id="depart" value="{{$mouvement->depart}}" class="form-control" required>
        </div>
    </div>


    <div class="row mt-1">
        <div class="col-sm-1"></div>
        <div class="col-md-4">
            DATE ET HEURE D'ARRIVEE
        </div>
        <div class="col-md-6">
            <input name="arrivee" type="datetime-local" id="arrivee" value="{{$mouvement->arrivee ? $mouvement->arrivee : null}}" class="form-control">
        </div>
{{--        <div class="col-md-2">--}}
{{--            <input name="time_arrivee" type="time" id="time_arrivee" value="{{$mouvement->time_arrivee ? $mouvement->time_arrivee->format('H:i') : null}}" class="form-control">--}}
{{--        </div>--}}
    </div>

    <input type="submit" class="btn btn-success pull-right" value="Enregistrer">
</form>
