<table class="table table-responsive table-striped" id="mouvements-table">
    <thead>
        <tr>
          <th>CENTRE DE SELECTION</th>
          <th>DATE ET HEURE DE DEPART</th>
          <th>DATE ET HEURE D'ARRIVEE</th>
          <th>EFFECTIF TRANSPORTE</th>
          <th>NOMBRE</th>
          <th>TYPE DE MOYEN</th>
          <th>CENTRE DE FORMATION</th>
          <th>STATUT</th>
          <th>ACTION</th>
        </tr>
    </thead>
    <tbody>
    @foreach($mouvements as $mouvement)
        <tr align="center">
            <td>{{$mouvement->selection}}</td>
            <td>{{$mouvement->depart->format('d.m.Y à H:i')}}</td>
            <td>{{$mouvement->arrivee ? $mouvement->arrivee->format('d.m.Y à H:i') : ''}}</td>
            <td>{{$mouvement->effectif}}</td>
            <td>{{$mouvement->nombre}}</td>
            @if($mouvement->moyen=='MO/FAR' && isset($mouvement->option_moyen))
            <td>{{$mouvement->moyen}}/{{$mouvement->option_moyen}}</td>
            @else
            <td>{{$mouvement->moyen}}</td>
            @endif
            <td>{{$mouvement->formation}}</td>
            <td>{{$mouvement->statut}}</td>
            <td>
                <button type="button" class="btn btn-info btn-xs" data-placement="top" title="Modifier" data-toggle="modal" data-target="#mouvement-{{$mouvement->id}}">
                    <i class="fa fa-edit"></i>
                </button>
            </td>
        </tr>
        <div class="modal fade" id="mouvement-{{$mouvement->id}}"  aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title"> MOUVEMENT N° {{$mouvement->id}}</h5>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-sm-12">
                                @include('mouvements.edit_fields_modal', $mouvement)
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
    @endforeach
    </tbody>
    <tfoot>
        <tr>
            <th>CENTRE DE SELECTION</th>
            <th>DATE ET HEURE DE DEPART</th>
            <th>DATE ET HEURE D'ARRIVEE</th>
            <th>EFFECTIF TRANSPORTE</th>
            <th>NOMBRE</th>
            <th>TYPE DE MOYEN</th>
            <th>CENTRE DE FORMATION</th>
            <th>STATUT</th>
            <th>ACTION</th>
        </tr>
    </tfoot>
</table>

<div class="modal fade" id="mouvement"  aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">NOUVEAU MOUVEMENT<span id="mouvement"></span></h5>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-sm-12">
                        @include('mouvements.show_fields_modal')
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
