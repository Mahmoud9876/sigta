<table class="table table-responsive table-striped text-center" id="coupons-table">
    <thead>
        <tr>
            <th rowspan="2">CENTRE DE SELECTION</th>
            <th colspan="2">P.M</th>
            <th colspan="2">NAVETTE</th>
            <th colspan="2">COUPON ONCF</th>
            <th colspan="2">COUPON VOIE ROUTIERE</th>
        </tr>
{{--        <tr>--}}
{{--            <th>TH</th>--}}
{{--            <th>P</th>--}}
{{--            <th>TH</th>--}}
{{--            <th>P</th>--}}
{{--            <th>TH</th>--}}
{{--            <th>P</th>--}}
{{--            <th>TH</th>--}}
{{--            <th>P</th>--}}
{{--        </tr>--}}
    </thead>
    <tbody>
        @foreach($selection_assujettis as $centre => $assujettis)
            <tr>
                <td>{{$centre}}</td>
                {{-- PROPRE MOYEN --}}
{{--                <td>--}}
{{--                    {{$pm_th=$assujettis->where('vers_selection_th', 'PROPRE MOYENS')->count()}}--}}
{{--                </td>--}}
                <td colspan="2">
                    {{$pm=$assujettis->where('vers_selection', 'PROPRE MOYEN')->count()}}
                </td>
                {{-- NAVETTE --}}
{{--                <td>--}}
{{--                    {{$navette_th=$assujettis->where('vers_selection_th', 'NAVETTE ')->count()}}--}}
{{--                </td>--}}
                <td colspan="2">
                    {{$navette=$assujettis->where('vers_selection', 'NAVETTE')->count()}}
                </td>
                {{-- COUPON ONCF --}}
{{--                <td>--}}
{{--                    {{$c_oncf_th=$assujettis->where('vers_selection_th', 'ONCF')->count()}}--}}
{{--                </td>--}}
                <td colspan="2">
                    {{$c_oncf=$assujettis->where('vers_selection', 'ONCF')->count()}}
                </td>
                {{-- COUPON CAR DE LIGNE --}}
{{--                <td>--}}
{{--                    {{$c_sntl_th=$assujettis->where('vers_selection_th', 'CAR DE LIGNE')->count()}}--}}
{{--                </td>--}}
                <td colspan="2">
                    {{$c_sntl=$assujettis->where('vers_selection', 'CAR DE LIGNE')->count()}}
                </td>
                @php
                    array_push($t_c_sntl, $c_sntl);
                    array_push($t_c_oncf, $c_oncf);
                    array_push($t_navette, $navette);
                    array_push($t_pm, $pm);
                @endphp
            </tr>
        @endforeach
            <tr>
                <td>TOTAUX</td>
{{--                <td>{{array_sum($t_pm_th)}}</td>--}}
                <td colspan="2">{{array_sum($t_pm)}}</td>
{{--                <td>{{array_sum($t_navette_th)}}</td>--}}
                <td colspan="2">{{array_sum($t_navette)}}</td>
{{--                <td>{{array_sum($t_c_oncf_th)}}</td>--}}
                <td colspan="2">{{array_sum($t_c_oncf)}}</td>
{{--                <td>{{array_sum($t_c_sntl_th)}}</td>--}}
                <td colspan="2">{{array_sum($t_c_sntl)}}</td>
            </tr>
    </tbody>
</table>
