<p class="pull-right">
    <strong><u id="entete"></u></strong>
<p align="center">
    <strong><u>INFORMATIONS PERSONNEL <span id="ndemande"></span></u></strong>
<p>
<br>
<br>
{{--<div class="col-sm-12">--}}
{{--    <div class="col-sm-12">--}}
{{--        <div class="col-sm-6">PRIX</div>--}}
{{--        <div class="col-sm-6">--}}
{{--            <div id="prix_label"></div>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--    <div class="col-sm-12">--}}
{{--        <div class="col-sm-6">TRAJET</div>--}}
{{--        <div class="col-sm-6">--}}
{{--            <div id="trajet_label"></div>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--    <div class="col-sm-12">--}}
{{--        <div class="col-sm-6">SELECTION</div>--}}
{{--        <div class="col-sm-6">--}}
{{--            <div id="selection_label"></div>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--    <div class="col-sm-12">--}}
{{--        <div class="col-sm-6">FORMATION</div>--}}
{{--        <div class="col-sm-6">--}}
{{--            <div id="formation_label"></div>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--    <div class="col-sm-12">--}}
{{--        <div class="col-sm-6">VERS SELECTION</div>--}}
{{--        <div class="col-sm-6">--}}
{{--            <div id="vers_selection_label"></div>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--    <div class="col-sm-12">--}}
{{--        <div class="col-sm-6">VERS FORMATION</div>--}}
{{--        <div class="col-sm-6">--}}
{{--            <div id="vers_formation_label"></div>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--    <br>--}}
{{--    <br>--}}
{{--    <br>--}}
{{--    <br>--}}
{{--</div>--}}

<input type="hidden" name="assujetti" id="assujetti">
<div class="row mt-1">
  <div class="col-md-6">
    NUMERO CNIE
  </div>
  <div class="col-md-6">
    <p id="cnie"><p>
  </div>
</div>
<div class="row mt-1">
  <div class="col-md-6">
    NOM
  </div>
  <div class="col-md-6">
    <p id="nom"><p>
  </div>
</div>
<div class="row mt-1">
  <div class="col-md-6">
      ADRESSE
  </div>
  <div class="col-md-6">
    <p>
      <ul style="list-style-type: none ;" id="adresse"></ul>
    <p>
  </div>
</div>
<div class="row mt-1">
  <div class="col-md-6">
      COMMUNE
  </div>
  <div class="col-md-6">
    <p>
      <ul style="list-style-type: none ;" id="commune">

      </ul>
    <p>
  </div>
</div>
<div class="row mt-1">
  <div class="col-md-6">
      PROVINCE
  </div>
  <div class="col-md-6">
    <p>
      <ul style="list-style-type: none ;" id="province">

      </ul>
    <p>
  </div>
</div>
<div class="row mt-1">
  <div class="col-md-6">
      DATE DE CONVOCATION
  </div>
  <div class="col-md-6">
    <p>
      <ul style="list-style-type: none ;" id="convocation">

      </ul>
    <p>
  </div>
</div>
<div class="row mt-1">
    <div class="col-md-6">
        CENTRE DE SELECTION
    </div>
    <div class="col-md-6">
        <p>
        <ul style="list-style-type: none ;" id="selection">

        </ul>
        <p>
    </div>
</div>

<p align="center">
    <strong><u> VOLET TRANSPORT </u></strong>
<p>

<hr>

<p>
    <h2> PREMIERE PHASE </h2>
<p>

<hr>
<div class="row mt-1">
    <div class="col-md-4">
        DATE DE PRESENTATION
    </div>
    <div class="col-md-7">
        <input name="presentation" type="date" id="presentation" value="" class="form-control">
    </div>
    <div class="col-sm-1">
        <img id="presentation_check" height="40px" width="40px">
    </div>
</div>

<div class="row mt-1">
    <div class="col-md-4">
        MOYEN DE TRANSPORT
    </div>
    <div class="col-md-7">
            <select name="vers_selection" id="vers_selection" class="form-control col-sm-6 select2">
                <option value="">DEFINIR LE MOYEN UTILISE</option>
                <option value="ONCF">COUPON ONCF</option>
                <option value="CAR DE LIGNE">COUPON CAR DE LIGNE</option>
                <option value="NAVETTE">NAVETTE</option>
                <option value="PROPRE MOYEN">PROPRE MOYEN</option>
                {{-- <option value="MOYEN MILITAIRE">MOYEN MILITAIRE</option> --}}
            </select>
    </div>
    <div class="col-sm-1">
        <img id="vers_selection_check" height="40px" width="40px">
    </div>
</div>

<div class="row mt-1">
    <div class="col-md-4">
        COUPON
    </div>
    <div class="col-md-7">
        <div class="col-md-2">
            <select name="coupons" id="coupons"  class="form-control select2">
                <option value="">COUPON</option>
                <option value="1">OUI</option>
                <option value="0">NON</option>
            </select>
        </div>

        <div class="col-md-4">
            <select name="ville_depart" id="ville_depart"  class="form-control select2">
                <option value="">Ville de départ</option>
                @foreach ($villes as $ville)
                <option value="{{ $ville->ville }}">
                    {{ $ville->ville }}</option>
            @endforeach
            </select>
        </div>
        <div class="col-md-4">
            <select name="ville_arrivee" id="ville_arrivee"  class="form-control select2">
                <option value="">Ville d'arrivée</option>
                @foreach ($villes as $ville)
                <option value="{{ $ville->ville }}">
                    {{ $ville->ville }}</option>
            @endforeach
            </select>
        </div>
        {{-- <div class="col-md-8">
            <input type="text" name="trajet" placeholder="TRAJET"  id="trajet" onchange="update(this.value, 'trajet')" onkeyup="this.value = this.value.toUpperCase();" class="form-control">
        </div> --}}
        <div class="col-md-2">
            <input type="number" name="prix" placeholder="PRIX" id="prix" class="form-control" onchange="update(this.value, 'prix')" step="0.01">
        </div>
    </div>
    <div class="col-sm-1">
        <img id="coupons_check" height="40px" width="40px">
    </div>
</div>

<p>
<h2> DEUXIEME PHASE </h2>
<p>

<hr>
<div class="row mt-1">
    <div class="col-md-4">
        ADMIS
    </div>
    <div class="col-md-7">
        <select name="admis" id="admis" class="form-control col-sm-6 select2">
            <option value="">ADMIS/INAPTE</option>
            <option value="1">ADMIS</option>
            <option value="0">INAPTE</option>
        </select>
    </div>
    <div class="col-sm-1">
        <img id="admis_check" height="40px" width="40px">
    </div>
</div>
<!-- Sections cachées par défaut -->
<div class="row mt-1" id="formation_section" style="display: none;">
    <div class="col-md-4">
        CENTRE DE FORMATION
    </div>
    <div class="col-md-7">
        <select name="formation" id="formation" class="form-control select2">
            <option value="">DEFINIR LE CENTRE DE FORMATION</option>
            @foreach($centres as $centre)
                <option value="{{$centre->centre}}">{{$centre->centre}}</option>
            @endforeach
        </select>
    </div>
    <div class="col-sm-1">
        <img id="formation_check" height="40px" width="40px">
    </div>
</div>

<div class="row mt-1" id="transport_section" style="display: none;">
    <div class="col-md-4">
        DATE DE TRANSPORT
    </div>
    <div class="col-md-7">
        <input name="transport" type="date" onchange="update(this.value, 'transport')" id="transport" value="" class="form-control">
    </div>
    <div class="col-sm-1">
        <img id="transport_check" height="40px" width="40px">
    </div>
</div>

<div class="row mt-1" id="vers_formation_section" style="display: none;">
    <div class="col-md-4">
        MOYEN DE TRANSPORT
    </div>
    <div class="col-md-7">
        <select name="vers_formation" id="vers_formation" class="form-control col-sm-6 select2">
            <option value="">DEFINIR LE MOYEN UTILISE</option>
            <option value="SNTL">CAR SNTL</option>
            <option value="ONCF">BON MODEL 8 (ONCF/SNTL)</option>
            <option value="GT">MOYEN MILITAIRE</option>
        </select>
    </div>
    <div class="col-sm-1">
        <img id="vers_formation_check" height="40px" width="40px">
    </div>
</div>

<div class="row mt-1" id="domicile_section" style="display: none;">
    <div class="col-md-4">
        RETOUR A DOMICILE
    </div>
    <div class="col-md-7">
        <select name="domicile" id="domicile" class="form-control col-sm-6 select2">
            <option value="">DEFINIR LE MOYEN UTILISE</option>
            <option value="NAVETTE">CAR SNTL</option>
            <option value="BON">BON MODEL 8(ONCF/SNTL)</option>
            <option value="PROPRE MOYEN">PROPRE MOYEN</option>
        </select>
    </div>
    <div class="col-sm-1">
        <img id="domicile_check" height="40px" width="40px">
    </div>
</div>
