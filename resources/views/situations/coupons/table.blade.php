<table class="table table-responsive table-striped text-center" id="coupons-table">
    <thead>
        <tr>
          <th rowspan="2">CENTRE DE SELECTION</th>
          <th colspan="5">COUPONS</th>
        </tr>
        <tr>
            <th>UTILISE</th>
            <th>THEORIQUE</th>
            <th>MONTANT SNTL</th>
            <th>MONTANT ONCF</th>
            <th>MONTANT TOTAL</th>
        </tr>
    </thead>
    <tbody>
        @foreach($selection_assujettis as $centre => $assujettis)
            <tr>
                <td>{{$centre}}</td>
                <td>
                    {{$selection_assujettis_pratique->has($centre) ? $selection_assujettis_pratique->get($centre)->count() : 0}}
                </td>
                <td>
                    {{$assujettis->count()}}
                </td>
                <td>
                    {{$selection_assujettis_pratique->has($centre) ? $sntl = $selection_assujettis_pratique->get($centre)
                                                                     ->where('vers_selection', 'CAR DE LIGNE')
                                                                     ->sum('prix') : 0}}
                </td>
                <td>
                    {{$selection_assujettis_pratique->has($centre) ? $oncf = $selection_assujettis_pratique->get($centre)
                                                                     ->where('vers_selection', 'ONCF')
                                                                     ->sum('prix') : 0}}
                </td>
                <td>
                    {{$selection_assujettis_pratique->has($centre) ? $sntl + $oncf : 0}}
                </td>
                @php
                    if($selection_assujettis_pratique->has($centre)) {
                        array_push($t_sntl, $sntl);
                        array_push($t_oncf, $oncf);
                    }
                @endphp
            </tr>
        @endforeach
            <tr>
                <td>TOTAUX</td>
                <td>{{$utilise}}</td>
                <td>{{$theorique}}</td>
                <td>{{array_sum($t_sntl)}}</td>
                <td>{{array_sum($t_oncf)}}</td>
                <td>{{array_sum($t_sntl) + array_sum($t_oncf)}}</td>
            </tr>
    </tbody>
</table>
