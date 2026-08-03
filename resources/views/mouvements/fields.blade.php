@if(isset($demande) && $demande->statut != 'non envoyée')
  {!! Form::hidden('id', $demande->id) !!}
@endif
<div class="form-group col-sm-12">
    {!! Form::label('au profil', 'AU PROFIL:') !!}
    <select name="auProfil[]" class="form-control select2" multiple="multiple" data-width="100%" required>\
      @foreach ($organesTutel as $organe)
        <option value="{{$organe->demandeur_id}}" <?php if(isset($demande)) if(in_array($organe->demandeur_id,$demande->auProfils->pluck('demandeur_id')->all())) echo 'selected'; ?>>{{$organe->demandeur}}</option>
      @endforeach
    </select>
</div>

<div class="form-group col-sm-4">
  {!! Form::label('degre', 'DEGRÉ D\'URGENCE:') !!}
  <select name="degreUrgence" class="form-control select2" required>
    <option value="" selected>SELECTIONNEZ LE DEGRE D'URGENCE</option>
    @foreach($degreUrgences as $degre)
      <option value="{{$degre}}" <?php if(isset($demande)) if(strtoupper($demande->degreUrgence) == strtoupper($degre)) echo 'selected'; ?>>
          {{strtoupper($degre)}}
      </option>
    @endforeach
  </select>
</div>

<div class="form-group col-sm-4">
  {!! Form::label('activite', 'ACTIVITÉ:') !!}
  <select name="activite_id" class="form-control select2"  required>
    <option value="" selected>SÉLÉCTIONNEZ UNE ACTIVITÉ</option>
    @foreach($activites as $activite)
      <option value="{{$activite->activite_id}}" <?php if(isset($demande)) if($demande->activite->activite_id == $activite->activite_id) echo 'selected'; ?>>{{$activite->activite}}</option>
    @endforeach
  </select>
</div>

<div class="form-group col-sm-4">
  {!! Form::label('type', 'TYPE:') !!}
  <select name="allerSimple" class="form-control select2"  required>
    <option value="1" <?php if(isset($demande)) if($demande->allerSimple) echo 'selected'; ?>>ALLER SIMPLE</option>
    <option value="0" <?php if(isset($demande)) if(!$demande->allerSimple) echo 'selected'; ?>>ALLER RETOUR</option>
  </select>
</div>

<div class="col-sm-1"></div>

<div class="form-group col-sm-3">
    {!! Form::label('dateMep', 'DATE MISE EN PLACE:') !!}
    {!! Form::date('meps[]', isset($demande) ? $demande->datedeparts->first()->date_mep : null, ['class' => 'form-control', 'required']) !!}
</div>

<div class="form-group col-sm-2">
    {!! Form::label('heure', 'HEURE:') !!}
    {!! Form::time('heureMep[]', isset($demande) ? $demande->datedeparts->first()->heure_mep : null, ['class' => 'form-control', 'required']) !!}
</div>

<div class="form-group col-sm-3">
    {!! Form::label('date', 'DATE DÉPART:') !!}
    {!! Form::date('departs[]', isset($demande) ? $demande->datedeparts->first()->date_depart : null, ['class' => 'form-control', 'required']) !!}
</div>

<div class="form-group col-sm-2">
    {!! Form::label('heure', 'HEURE:') !!}
    {!! Form::time('heureDepart[]', isset($demande) ? $demande->datedeparts->first()->heure_depart : null, ['class' => 'form-control', 'required']) !!}
</div>
<div class="col-sm-1"></div>

<div class="col-sm-1" style="margin-top: 24px;">
    {!! Form::button('<i class="fa fa-plus"></i>', array('class' => 'btn btn-light', 'id' => 'plusDepart')) !!}
</div>

<div class="col-sm-12" id="position_fields_depart" >
</div>

<div class="col-sm-1"></div>

<div class="form-group col-sm-5">
    {!! Form::label('enlevements', 'ENLEVEMENT:') !!}
    <select name="enlevements[]" class="form-control select2" multiple="multiple" data-width="100%" required>\
      @foreach ($organes as $organe)
        <option value="{{$organe->demandeur_id}}" <?php if(isset($demande)) if(in_array($organe->demandeur_id,$demande->enlevements->pluck('demandeur_id')->all())) echo 'selected'; ?>>{{$organe->demandeur}}</option>
      @endforeach
    </select>
</div>

<div class="form-group col-sm-5">
    {!! Form::label('villeDepart', 'VILLE DE DÉPART:') !!}
    {!! Form::text('villeDepart', isset($demande) ? $demande->villeDepart : null, ['class' => 'form-control', 'required', 'onkeyup' => 'this.value = this.value.toUpperCase();']) !!}
</div>

<div class="col-sm-12"></div>
<div class="col-sm-1"></div>

<div class="form-group col-sm-5">
    {!! Form::label('destination', 'DESTINATION:') !!}
    <select name="destinations[]" class="form-control select2" multiple="multiple" data-width="100%" required>
      @foreach ($organes as $organe)
        <option value="{{$organe->demandeur_id}}" <?php if(isset($demande)) if(in_array($organe->demandeur_id,$demande->destinations->pluck('demandeur_id')->all())) echo 'selected'; ?>>{{$organe->demandeur}}</option>
      @endforeach
    </select>
</div>

<div class="form-group col-sm-5">
    {!! Form::label('villeArrivee', 'VILLE DE DESTINATION:') !!}
    {!! Form::text('villeArrivee', isset($demande) ? $demande->villeArrivee : null, ['class' => 'form-control', 'required', 'onkeyup' => 'this.value = this.value.toUpperCase();']) !!}
</div>

<div class="col-sm-12"></div>

@if(isset($materiels))
  @include('code.demande.materiel')
@elseif(isset($personnels))
  @include('code.demande.personnel')
@endif

@include('code.demande.vehicule')
<div class="col-sm-1"></div>
<div class="form-group col-sm-12 col-lg-10">
    {!! Form::label('itineraire', 'ITINERAIRE:') !!}
    {!! Form::text('itineraire', isset($demande) ? $demande->itineraire : null, ['class' => 'form-control', 'required', 'onkeyup' => 'this.value = this.value.toUpperCase();']) !!}
</div>
<div class="col-sm-12"></div>
<div class="col-sm-1"></div>
<div class="form-group col-sm-12 col-lg-10">
    {!! Form::label('reference', 'RÉFÉRENCE DE L\'AUTORISATION:') !!}
    {!! Form::text('references[]', isset($demande) ? $demande->referencesDemande->first()->reference : null, ['class' => 'form-control', 'required', 'onkeyup' => 'this.value = this.value.toUpperCase();']) !!}
</div>
<div class="form-group col-sm-1" style="margin-top: 24px;" >
    {!! Form::button('<i class="fa fa-plus"></i>', array('class' => 'btn btn-light', 'id'=> 'plusReference')) !!}
</div>
<div class="col-sm-12" id="position_fields_Reference" ></div>
<div class="col-sm-1"></div>
<div class="form-group col-sm-10">
    {!! Form::label('observation', 'OBSERVATION:') !!}
    {!! Form::textarea('observation', isset($demande) ? $demande->observation : null, ['class' => 'form-control', 'onkeyup' => 'this.value = this.value.toUpperCase();']) !!}
</div>
<div class="col-sm-12"></div>

@if(isset($demande))
  @if($demande->attachements->isNotEmpty())
    @include('code.demande.attachement')
  @endif
@endif

<div class="form-group col-sm-12">
    {!! Form::submit('Enregistrer', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('organes.demandes.index') !!}" class="btn btn-default">Cancel</a>
    <label  for="input" class="btn btn-success">Attachements</label>
    <input type="file" style="display: none" name="attachement[]" id="input" accept="image/png, image/jpeg, application/pdf" multiple="multiple">
</div>

@include('scripts.demande.demande')
