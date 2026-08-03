<table class="table table-responsive table-striped table-bordered" id="assujettis-table">
    <thead>
        <tr>
          <th>CNIE</th>
          <th>NOM ET PRENOM</th>
          <th>SEXE</th>
          <th>DATE DE CONVOCATION</th>
          <th>DATE DE PRESENTATION</th>
          <th>CENTRE DE SELECTION</th>
          <th>ADMIS</th>
          <th>CENTRE DE FORMATION</th>
          <th>VERS SELECTION</th>
          <th>VERS FORMATION</th>
          <th>RETOUR A DOMICILE</th>
          <th>ACTION</th>
        </tr>
    </thead>
    <tbody>

    </tbody>
    <tfoot>
        <tr>
            <th>CNIE</th>
            <th>NOM ET PRENOM</th>
            <th>SEXE</th>
            <th>DATE DE CONVOCATION</th>
            <th>DATE DE PRESENTATION</th>
            <th>CENTRE DE SELECTION</th>
            <th>ADMIS</th>
            <th>CENTRE DE FORMATION</th>
            <th>VERS SELECTION</th>
            <th>VERS FORMATION</th>
            <th>DOMICILE</th>
            <th>ACTION</th>
        </tr>
    </tfoot>
</table>

<div class="modal fade" id="assujetti"  aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">ASSUJETIS: <span id="identite"></span></h5>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-sm-12">
                        @include('assujettis.show_fields_modal')
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <div class="col-sm-1">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Retour</button>
                </div>
            </div>
        </div>
    </div>
</div>
