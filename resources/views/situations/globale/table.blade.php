<table class="table table-responsive table-striped table-bordered" id="globale-table">
    <thead>
        <tr>
            <th rowspan="3" class="text-center ">CENTRE DE SELECTION</th>
            <th colspan="3" class="text-center">EFFECTIF</th>
            <th colspan="27" class="text-center">REPARTITION PAR CENTRE DE FORMATION</th>
            <th colspan="3"class="text-center">MOYEN DE TRANSPORT</th>
        </tr>
        <tr>
            <th rowspan="2" align="center">CONVOQUE</th>
            <th rowspan="2" align="center">PRESENTE</th>
            <th rowspan="2" align="center">ADMIS</th>

            <th colspan="2" align="center">1°CRFI</th>
            <th rowspan="2" align="center">1°CFA ({{ $centres->where('centre', '1°CFA')->first()->masculin }})</th>
            <th rowspan="2" align="center">2°CRFI ({{ $centres->where('centre', '2°CRFI')->first()->masculin }})</th>
            <th colspan="2" align="center">2°CFA</th>
            <th rowspan="2" align="center">6°CFA ({{ $centres->where('centre', '6°CFA')->first()->masculin }})</th>
            <th rowspan="2" align="center">CISS (PF) ({{ $centres->where('centre', 'CISS')->first()->feminin }})</th>
            <th colspan="2" align="center">7°CFA </th>
            <th rowspan="2" align="center">5°CFA ({{ $centres->where('centre', '5°CFA')->first()->masculin }})
            </th>
            <th rowspan="2" align="center">4°CFA ({{ $centres->where('centre', '4°CFA')->first()->masculin }})</th>
            <th rowspan="2" align="center">2°BAFRA ({{ $centres->where('centre', '2°BAFRA')->first()->masculin }})
            </th>
            <th rowspan="2" align="center">3°BAFRA ({{ $centres->where('centre', '3°BAFRA')->first()->masculin }})
            </th>
            <th rowspan="2" align="center">5°BAFRA ({{ $centres->where('centre', '5°BAFRA')->first()->masculin }})
            </th>
            <th rowspan="2" align="center">3°CFA ({{ $centres->where('centre', '3°CFA')->first()->masculin }})
            </th>
            <th rowspan="2" align="center">BEFRA ({{ $centres->where('centre', 'BEFRA')->first()->masculin }})</th>
            <th rowspan="2" align="center">BASG (PF) ({{ $centres->where('centre', 'BASG')->first()->feminin }})</th>
            <th rowspan="2" align="center">13°BRIMOTO ({{ $centres->where('centre', '13°BRIMOTO')->first()->masculin }})</th>
            <th rowspan="2" align="center">1°BN ({{ $centres->where('centre', '1°BN')->first()->masculin }})</th>
            <th rowspan="2" align="center">5°BMI ({{ $centres->where('centre', '5°BMI')->first()->masculin }})</th>
            <th rowspan="2" align="center">12°RRC ({{ $centres->where('centre', '12°RRC')->first()->masculin }})</th>
            <th rowspan="2" align="center">7°GAR ({{ $centres->where('centre', '7°GAR')->first()->masculin }})</th>
            <th rowspan="2" align="center">1°B.GEN ({{ $centres->where('centre', '1°B.GENIE')->first()->masculin }})</th>
            {{--  nouvellement ajouté --}}
            <th rowspan="2" align="center">23°GAR ({{ $centres->where('centre', '23°GAR')->first()->masculin }})</th>
            <th rowspan="2" align="center">1°GT ({{ $centres->where('centre', '1°GT')->first()->masculin }})</th>
            <th rowspan="2" align="center">1°GEC ({{ $centres->where('centre', '1°GEC')->first()->masculin }})</th>


            <th rowspan="2" align="center">SNTL</th>
            <th rowspan="2" align="center">MILITAIRE</th>
            <th rowspan="2" align="center">BON MODEL 8</th>

        </tr>
        <tr>
            <th align="center">PM ({{ $centres->where('centre', '1°CRFI')->first()->masculin }})</th>
            <th align="center">PF ({{ $centres->where('centre', '1°CRFI')->first()->feminin }})</th>
            <th align="center">PM ({{ $centres->where('centre', '2°CFA')->first()->masculin }})</th>
            <th align="center">PF ({{ $centres->where('centre', '2°CFA')->first()->feminin }})</th>
            <th align="center">PM ({{ $centres->where('centre', '7°CFA')->first()->masculin }})</th>
            <th align="center">PF ({{ $centres->where('centre', '7°CFA')->first()->feminin }})</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($selection_assujettis as $centre => $assujettis)
        <tr class="ligne-cliquable">

                <td align="center">{{ str_replace('-', '/', $centre) }}</td>
                <td align="center">{{ $a_convoque = $selection_assujettis[$centre]->count() }} </td> @php $convoque += $a_convoque @endphp
                <td align="center" id="{{ $centre . '-presentation' }}">
                    {{ $a_presente = $selection_assujettis[$centre]->whereNotNull('presentation')->count() }}</td>
                @php $presente += $a_presente @endphp
                <td align="center" id="{{ $centre . '-admis' }}">
                    {{ $a_admis = $selection_assujettis[$centre]->where('admis', true)->count() }}</td>
                @php $admis += $a_admis @endphp

                <td align="center" id="{{ $centre . '-1°CRFI_M' }}">
                    {{ $a_crfi1_m = $selection_assujettis[$centre]->where('formation', '1°CRFI')->where('sexe', 'M')->count() }}
                </td> @php $crfi1_m += $a_crfi1_m @endphp
                <td align="center" id="{{ $centre . '-1°CRFI_F' }}">
                    {{ $a_crfi1_f = $selection_assujettis[$centre]->where('formation', '1°CRFI')->where('sexe', 'F')->count() }}
                </td> @php $crfi1_f += $a_crfi1_f @endphp
                <td align="center" id="{{ $centre . '-1°CFA' }}">
                    {{ $a_cfa1 = $selection_assujettis[$centre]->where('formation', '1°CFA')->count() }}</td>
                @php $cfa1 += $a_cfa1 @endphp
                <td align="center" id="{{ $centre . '-2°CRFI' }}">
                    {{ $a_crfi2 = $selection_assujettis[$centre]->where('formation', '2°CRFI')->count() }}</td>
                @php $crfi2 += $a_crfi2 @endphp
                <td align="center" id="{{ $centre . '-2°CFA_M' }}">
                    {{ $a_cfa2_m = $selection_assujettis[$centre]->where('formation', '2°CFA')->where('sexe', 'M')->count() }}
                </td> @php $cfa2_m += $a_cfa2_m @endphp
                <td align="center" id="{{ $centre . '-2°CFA_F' }}">
                    {{ $a_cfa2_f = $selection_assujettis[$centre]->where('formation', '2°CFA')->where('sexe', 'F')->count() }}
                </td> @php $cfa2_f += $a_cfa2_f @endphp

                <td align="center" id="{{ $centre . '-6°CFA' }}">
                    {{ $a_cfa6 = $selection_assujettis[$centre]->where('formation', '6°CFA')->count() }}</td>
                @php $cfa6 += $a_cfa6 @endphp
                <td align="center" id="{{ $centre . '-CISS' }}">
                    {{ $a_ciss = $selection_assujettis[$centre]->where('formation', 'CISS')->count() }}</td>
                @php $ciss += $a_ciss @endphp
                <td align="center" id="{{ $centre . '-7°CFA_M' }}">
                    {{ $a_cfa7_m = $selection_assujettis[$centre]->where('formation', '7°CFA')->where('sexe', 'M')->count() }}
                </td> @php $cfa7_m += $a_cfa7_m @endphp
                <td align="center" id="{{ $centre . '-7°CFA_F' }}">
                    {{ $a_cfa7_f = $selection_assujettis[$centre]->where('formation', '7°CFA')->where('sexe', 'F')->count() }}
                </td> @php $cfa7_f += $a_cfa7_f @endphp
                <td align="center" id="{{ $centre . '-5°CFA' }}">
                    {{ $a_cfa5 = $selection_assujettis[$centre]->where('formation', '5°CFA')->count() }}</td>
                @php $cfa5 += $a_cfa5 @endphp
                <td align="center" id="{{ $centre . '-4°CFA' }}">
                    {{ $a_cfa4 = $selection_assujettis[$centre]->where('formation', '4°CFA')->count() }}</td>
                @php $cfa4 += $a_cfa4 @endphp
                <td align="center" id="{{ $centre . '-2°BAFRA' }}">
                    {{ $a_bafra2 = $selection_assujettis[$centre]->where('formation', '2°BAFRA')->count() }}</td>
                @php $bafra2 += $a_bafra2 @endphp
                <td align="center" id="{{ $centre . '-3°BAFRA' }}">
                    {{ $a_bafra3 = $selection_assujettis[$centre]->where('formation', '3°BAFRA')->count() }}</td>
                @php $bafra3 += $a_bafra3 @endphp
                <td align="center" id="{{ $centre . '-5°BAFRA' }}">
                    {{ $a_bafra5 = $selection_assujettis[$centre]->where('formation', '5°BAFRA')->count() }}</td>
                @php $bafra5 += $a_bafra5 @endphp
                <td align="center" id="{{ $centre . '-3°CFA' }}">
                    {{ $a_cfa3 = $selection_assujettis[$centre]->where('formation', '3°CFA')->count() }}</td>
                @php $cfa3 += $a_cfa3 @endphp
                <td align="center" id="{{ $centre . '-BEFRA' }}">
                    {{ $a_befra = $selection_assujettis[$centre]->where('formation', 'BEFRA')->count() }}</td>
                @php $befra += $a_befra @endphp
                <td align="center" id="{{ $centre . '-BASG' }}">
                    {{ $a_basg = $selection_assujettis[$centre]->where('formation', 'BASG')->count() }}</td>
                @php $basg += $a_basg @endphp
                <td align="center" id="{{ $centre . '-13°BRIMOTO' }}">
                    {{ $a_brimoto13 = $selection_assujettis[$centre]->where('formation', '13°BRIMOTO')->count() }}</td>
                @php $brimoto13 += $a_brimoto13 @endphp

                <td align="center" id="{{ $centre . '-1°BN' }}">
                    {{ $a_bn1 = $selection_assujettis[$centre]->where('formation', '1°BN')->count() }}</td>
                @php $bn1 += $a_bn1 @endphp

                <td align="center" id="{{ $centre . '-5°BMI' }}">
                    {{ $a_bmi5 = $selection_assujettis[$centre]->where('formation', '5°BMI')->count() }}</td>
                @php $bmi5 += $a_bmi5 @endphp
                <td align="center" id="{{ $centre . '-12°RRC' }}">
                    {{ $a_rrc12 = $selection_assujettis[$centre]->where('formation', '12°RRC')->count() }}</td>
                @php $rrc12 += $a_rrc12 @endphp
                <td align="center" id="{{ $centre . '-7°GAR' }}">
                    {{ $a_gar7 = $selection_assujettis[$centre]->where('formation', '7°GAR')->count() }}</td>
                @php $gar7 += $a_gar7 @endphp
                <td align="center" id="{{ $centre . '-1°B.GENIE' }}">
                    {{ $a_bgenie1 = $selection_assujettis[$centre]->where('formation', '1°B.GENIE')->count() }}</td>
                @php $bgenie1 += $a_bgenie1 @endphp

                    {{-- nouvellement ajouté --}}
                    <td align="center" id="{{ $centre . '-23°GAR' }}">
                        {{ $a_gar23 = $selection_assujettis[$centre]->where('formation', '23°GAR')->count() }}</td>
                    @php $gar23 += $a_gar23 @endphp
                    <td align="center" id="{{ $centre . '-1°GT' }}">
                        {{ $a_gt1 = $selection_assujettis[$centre]->where('formation', '1°GT')->count() }}</td>
                    @php $gt1 += $a_gt1 @endphp
                    <td align="center" id="{{ $centre . '-1°GEC' }}">
                        {{ $a_gec1 = $selection_assujettis[$centre]->where('formation', '1°GEC')->count() }}</td>
                    @php $gec1 += $a_gec1 @endphp

                <td align="center" id="{{ str_replace('-', '/', $centre) . '-SNTL' }}">
                    {{ $a_sntl = $selection_assujettis[$centre]->where('admis', true)->where('vers_formation', 'SNTL')->count() }}
                </td>
                @php $sntl += $a_sntl @endphp
                <td align="center" id="{{ str_replace('-', '/', $centre) . '-GT' }}">
                    {{ $a_gt = $selection_assujettis[$centre]->where('admis', true)->where('vers_formation', 'GT')->count() }}
                </td>
                @php $gt += $a_gt @endphp
                <td align="center" id="{{ str_replace('-', '/', $centre) . '-BON' }}">
                    {{ $a_bon = $selection_assujettis[$centre]->where('admis', true)->where('vers_formation', 'ONCF')->count() }}
                </td>
                @php $bon += $a_bon @endphp
            </tr>
        @endforeach
        <tr>
            <td align="center">TOTAL</td>
            <td align="center">{{ $convoque }}</td>
            <td align="center" id="total-presentation">{{ $presente }}</td>
            <td align="center" id="total-admis">{{ $admis }}</td>
            <td align="center" id="{{ '1°CRFI_M-total' }}">{{ $crfi1_m }} </td>
            <td align="center" id="{{ '1°CRFI_F-total' }}">{{ $crfi1_f }}</td>
            <td align="center" id="{{ '1°CFA-total' }}">{{ $cfa1 }}</td>
            <td align="center" id="{{ '2°CRFI-total' }}">{{ $crfi2 }}</td>
            <td align="center" id="{{ '2°CFA_M-total' }}">{{ $cfa2_m }}</td>
            <td align="center" id="{{ '2°CFA_F-total' }}">{{ $cfa2_f }}</td>
            <td align="center" id="{{ '6°CFA-total' }}">{{ $cfa6 }}</td>
            <td align="center" id="{{ 'CISS-total' }}">{{ $ciss }}</td>
            <td align="center" id="{{ '7°CFA_M-total' }}">{{ $cfa7_m }}</td>
            <td align="center" id="{{ '7°CFA_F-total' }}">{{ $cfa7_f }}</td>
            <td align="center" id="{{ '5°CFA-GSA-total' }}">{{ $cfa5 }}</td>
            <td align="center" id="{{ '4°CFA-total' }}">{{ $cfa4 }}</td>
            <td align="center" id="{{ '2°BAFRA-total' }}">{{ $bafra2 }}</td>
            <td align="center" id="{{ '3°BAFRA-total' }}">{{ $bafra3 }}</td>
            <td align="center" id="{{ '5°BAFRA-total' }}">{{ $bafra5 }}</td>
            <td align="center" id="{{ '3°CFA-2°BIP-total' }}">{{ $cfa3 }}</td>
            <td align="center" id="{{ 'BEFRA-total' }}">{{ $befra }}</td>
            <td align="center" id="{{ 'BASG-total' }}">{{ $basg }}</td>
            <td align="center" id="{{ '13°BRIMOTO-total' }}">{{ $brimoto13 }}</td>
            <td align="center" id="{{ '1°BN-total' }}">{{ $bn1 }}</td>
            <td align="center" id="{{ '5°BMI-total' }}">{{ $bmi5 }}</td>
            <td align="center" id="{{ '12°RRC-total' }}">{{ $rrc12 }}</td>
            <td align="center" id="{{ '7°GAR-total' }}">{{ $gar7 }}</td>
            <td align="center" id="{{ '1°B.GENIE' }}">{{ $bgenie1 }}</td>



            <td align="center" id="{{ 'SNTL-total' }}">{{ $sntl }}</td>
            <td align="center" id="{{ 'GT-total' }}">{{ $gt }}</td>
            <td align="center" id="{{ 'BON-total' }}">{{ $bon }}</td>

        </tr>
    </tbody>
</table>
