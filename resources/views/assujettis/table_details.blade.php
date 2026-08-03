<table class="table table-responsive table-striped" id="assujettis-details-table">
    <thead>
        <tr align="center">
          <th rowspan="2">CENTRE DE SELECTION</th>
          <th rowspan="2">LIEU DE PROVENANCE</th>
          <th colspan="2">IDENTITE</th>
          <th colspan="4">MOYENS DE TRANSPORT EMPRUNTER</th>
          <th colspan="2">COUT</th>
        </tr>
        <tr align="center">
            <th>NOM & PRENOM</th>
            <th>CNI</th>
            <th>NAVETTE</th>
            <th>ONCF</th>
            <th>CAR DE LIGNE</th>
            <th>PROPRE MOYEN</th>
            <th>ONCF</th>
            <th>CAR DE LIGNE</th>
        </tr>
    </thead>
    <tbody>
        @foreach($assujettis as $key => $centre)
            <tr>
                <td rowspan="{{$centre->count()}}">
                    {{$key}}
                </td>
                @foreach($centre as $assujetti)
                    <td>
                        {{$assujetti->province}}
                    </td>
                    <td>{{$assujetti->nom}}</td>
                    <td>{{$assujetti->cnie}}</td>
                    <td>{{$assujetti->vers_selection == 'NAVETTE' ? 'OUI' : ''}}</td>
                    <td>{{$assujetti->vers_selection == 'ONCF' ? 'OUI' : ''}}</td>
                    <td>{{$assujetti->vers_selection == 'CAR DE LIGNE' ? 'OUI' : ''}}</td>
                    <td>{{$assujetti->vers_selection == 'PROPRE MOYEN' ? 'OUI' : ''}}</td>
                    <td>{{$assujetti->vers_selection == 'ONCF' ? $assujetti->prix : ''}}</td>
                    <td>{{$assujetti->vers_selection == 'CAR DE LIGNE' ? $assujetti->prix : ''}}</td>
            </tr>
            @endforeach
        @endforeach
    </tbody>
</table>
