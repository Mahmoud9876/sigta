<table class="table table-responsive table-striped" id="globale-table">
    <thead>
        <tr>
            <th rowspan="3" align="center">CENTRE DE SELECTION</th>
            <th colspan="3" align="center">EFFECTIF</th>
            <th colspan="16" align="center">REPARTITION PAR CENTRE DE FORMATION</th>
            <th colspan="2" align="center">MOYEN DE TRANSPORT</th>
        </tr>
        <tr>
            <th rowspan="2" align="center">CONVOQUE</th>
            <th rowspan="2" align="center">PRESENTE</th>
            <th rowspan="2" align="center">ADMIS</th>

            <th colspan="2" align="center">1°CRFI</th>
            <th colspan="2" align="center">2°CRFI</th>
            <th rowspan="2" align="center">6°CFA ({{ $centres->where('centre', '6°CFA')->first()->masculin }})</th>
            <th rowspan="2" align="center">CISS (PF) ({{ $centres->where('centre', 'CISS')->first()->feminin }})</th>
            <th colspan="2" align="center">7°CFA </th>
            <th rowspan="2" align="center">5°CFA ({{ $centres->where('centre', '5°CFA')->first()->masculin }})</th>
            <th rowspan="2" align="center">4°CFA ({{ $centres->where('centre', '4°CFA')->first()->masculin }})</th>
            <th rowspan="2" align="center">2°BAFRA ({{ $centres->where('centre', '2°BAFRA')->first()->masculin }})
            </th>
            <th rowspan="2" align="center">3°BAFRA ({{ $centres->where('centre', '3°BAFRA')->first()->masculin }})
            </th>
            <th rowspan="2" align="center">5°BAFRA ({{ $centres->where('centre', '5°BAFRA')->first()->masculin }})
            </th>
            <th rowspan="2" align="center">3°CFA ({{ $centres->where('centre', '3°CFA')->first()->masculin }})</th>
            <th rowspan="2" align="center">BEFRA ({{ $centres->where('centre', 'BEFRA')->first()->masculin }})</th>
            <th rowspan="2" align="center">BASG (PF) ({{ $centres->where('centre', 'BASG')->first()->feminin }})</th>

            <th rowspan="2" align="center">SNTL</th>
            <th rowspan="2" align="center">MILITAIRE</th>
        </tr>
        <tr>
            <th align="center">PM ({{ $centres->where('centre', '1°CFA/1°CRFI')->first()->masculin }})</th>
            <th align="center">PF ({{ $centres->where('centre', '1°CFA/1°CRFI')->first()->feminin }})</th>
            <th align="center">PM ({{ $centres->where('centre', '2°CFA/2°CRFI')->first()->masculin }})</th>
            <th align="center">PF ({{ $centres->where('centre', '2°CFA/2°CRFI')->first()->feminin }})</th>
            <th align="center">PM ({{ $centres->where('centre', '7°CFA')->first()->masculin }})</th>
            <th align="center">PF ({{ $centres->where('centre', '7°CFA')->first()->feminin }})</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($selection_assujettis as $centre => $assujettis)
            <tr>
                <td align="center">{{ $centre }}</td>
                <td align="center">{{ $a_convoque = $selection_assujettis[$centre]->count() }} </td> @php $convoque += $a_convoque @endphp
                <td align="center">
                    {{ $a_presente = $selection_assujettis[$centre]->whereNotNull('presentation')->count() }}</td>
                @php $presente += $a_presente @endphp
                <td align="center">{{ $a_admis = $selection_assujettis[$centre]->where('admis', true)->count() }}
                </td> @php $admis += $a_admis @endphp

                <td align="center">
                    {{ $a_crfi1_m = $selection_assujettis[$centre]->where('formation', '1°CFA/1°CRFI')->where('sexe', 'M')->count() }}
                </td> @php $crfi1_m += $a_crfi1_m @endphp
                <td align="center">
                    {{ $a_crfi1_f = $selection_assujettis[$centre]->where('formation', '1°CFA/1°CRFI')->where('sexe', 'F')->count() }}
                </td> @php $crfi1_f += $a_crfi1_m @endphp
                <td align="center">
                    {{ $a_crfi2_m = $selection_assujettis[$centre]->where('formation', '2°CFA/2°CRFI')->where('sexe', 'M')->count() }}
                </td> @php $crfi2_m += $a_crfi2_m @endphp
                <td align="center">
                    {{ $a_crfi2_f = $selection_assujettis[$centre]->where('formation', '2°CFA/2°CRFI')->where('sexe', 'F')->count() }}
                </td> @php $crfi2_f += $a_crfi2_f @endphp
                <td align="center">{{ $a_brb6 = $selection_assujettis[$centre]->where('formation', '6°CFA')->count() }}
                </td> @php $brb6 += $a_brb6 @endphp
                <td align="center">{{ $a_ciss = $selection_assujettis[$centre]->where('formation', 'CISS')->count() }}
                </td> @php $ciss += $a_ciss @endphp
                <td align="center">
                    {{ $a_cfa7_m = $selection_assujettis[$centre]->where('formation', '7°CFA')->where('sexe', 'M')->count() }}
                </td> @php $cfa7_m += $a_cfa7_m @endphp
                <td align="center">
                    {{ $a_cfa7_f = $selection_assujettis[$centre]->where('formation', '7°CFA')->where('sexe', 'F')->count() }}
                </td> @php $cfa7_f += $a_cfa7_f @endphp
                <td align="center">{{ $a_cfa5 = $selection_assujettis[$centre]->where('formation', '5°CFA')->count() }}
                </td> @php $cfa5 += $a_cfa5 @endphp
                <td align="center">{{ $a_cfa4 = $selection_assujettis[$centre]->where('formation', '4°CFA')->count() }}
                </td> @php $cfa4 += $a_cfa4 @endphp
                <td align="center">
                    {{ $a_bafra2 = $selection_assujettis[$centre]->where('formation', '2°BAFRA')->count() }}</td>
                @php $bafra2 += $a_bafra2 @endphp
                <td align="center">
                    {{ $a_bafra3 = $selection_assujettis[$centre]->where('formation', '3°BAFRA')->count() }}</td>
                @php $crfi1_m += $a_crfi1_m @endphp
                <td align="center">
                    {{ $a_bafra5 = $selection_assujettis[$centre]->where('formation', '5°BAFRA')->count() }}</td>
                @php $bafra5 += $a_bafra5 @endphp
                <td align="center">{{ $a_cfa3 = $selection_assujettis[$centre]->where('formation', '3°CFA')->count() }}
                </td> @php $cfa3 += $a_cfa3 @endphp
                <td align="center">
                    {{ $a_befra = $selection_assujettis[$centre]->where('formation', 'BEFRA')->count() }}</td>
                @php $befra += $a_befra @endphp
                <td align="center">{{ $basg = $selection_assujettis[$centre]->where('formation', 'BASG')->count() }}
                </td> @php $basg += $a_basg @endphp

                <td align="center">
                    {{ $a_sntl = $selection_assujettis[$centre]->where('vers_formation', 'SNTL')->count() }}</td>
                @php $sntl += $a_sntl @endphp
                <td align="center">{{ $a_gt = $selection_assujettis[$centre]->where('vers_formation', 'GT')->count() }}
                </td> @php $gt += $a_gt @endphp
            </tr>
        @endforeach
        <tr>
            <td align="center">TOTAL</td>
            <td align="center">{{ $convoque }}</td>
            <td align="center">{{ $presente }}</td>
            <td align="center">{{ $admis }}</td>

            <td align="center">{{ $crfi1_m }} </td>
            <td align="center">{{ $crfi1_f }}</td>
            <td align="center">{{ $crfi2_m }}</td>
            <td align="center">{{ $crfi2_f }}</td>
            <td align="center">{{ $brb6 }}</td>
            <td align="center">{{ $ciss }}</td>
            <td align="center">{{ $cfa7_m }}</td>
            <td align="center">{{ $cfa7_f }}</td>
            <td align="center">{{ $cfa5 }}</td>
            <td align="center">{{ $cfa4 }}</td>
            <td align="center">{{ $bafra2 }}</td>
            <td align="center">{{ $bafra3 }}</td>
            <td align="center">{{ $bafra5 }}</td>
            <td align="center">{{ $cfa3 }}</td>
            <td align="center">{{ $befra }}</td>
            <td align="center">{{ $basg }}</td>

            <td align="center">{{ $sntl }}</td>
            <td align="center">{{ $gt }}</td>
        </tr>
    </tbody>
</table>
