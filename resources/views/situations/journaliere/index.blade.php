@extends('layouts.apps')

@if (Request::has('date'))
    @section('title', 'SITUATION JOURNALIERE DES MOUVEMENTS DU ' . date('d.m.Y', strtotime(Request::get('date'))))
@else
    @section('title', 'SITUATION JOURNALIERE DES MOUVEMENTS DU ' . now()->format('d.m.Y'))
@endif

@section('css')
    <link rel="stylesheet" href="{{ URL::asset('assets/css/jquery.dataTables.min.css') }}">
    <style>
        div.dt-buttons {
            margin-left: 10px;
            float: right;
        }

        .ligne-selectionnee {
            background-color: #15d642 !important;
            /* Vert clair */
            font-weight: bold;
        }
    </style>
@endsection

@section('content')
    <section class="content-header">
        <h1 class="pull-left">SITUATION JOURNALIERE DES MOUVEMENTS DES APPELES VERS LES CENTRES DE FORMATIONS
            DU {{ Request::has('date') ? date('d.m.Y', strtotime(Request::get('date'))) : now()->format('d.m.Y') }}
        </h1>

        <div class="col-sm-12">
            <div class="col-sm-8"></div>
            <div class="col-sm-4">
                <form action="{{ route('situations.journaliere') }}" method="get">
                    <div class="col-sm-8">
                        <input name="date" type="date" id="date"
                            value="{{ Request::has('date') ? Request::get('date') : null }}" class="form-control">
                    </div>
                    <div class="col-sm-4">
                        <input type="submit" value="Filtrer" class="btn btn-default">
                    </div>
                </form>
            </div>
        </div>
    </section>
    <div class="content">
        <div class="clearfix  mt-1"></div>

        @php
            $convoque = 0;
            $presente = 0;
            $admis = 0;
            $crfi1_m = 0;
            $crfi1_f = 0;
            $crfi2 = 0;
            $cfa1 = 0;
            $cfa2_m = 0;
            $cfa2_f = 0;
            $cfa6 = 0;
            $ciss = 0;
            $cfa7_m = 0;
            $cfa7_f = 0;
            $cfa5 = 0;
            $cfa4 = 0;
            $bafra2 = 0;
            $bafra3 = 0;
            $bafra5 = 0;
            $cfa3 = 0;
            $befra = 0;
            $basg = 0;
            $brimoto13 = 0;
            $bn1 = 0;
            $bmi5 = 0;
            $rrc12 = 0;
            $gar7 = 0;
            $bgenie1 = 0;
            $gar23 = 0;
            $gt1 = 0;
            $gec1 = 0;

            $sntl = 0;
            $gt = 0;
            $bon = 0;

            $a_convoque = 0;
            $a_presente = 0;
            $a_admis = 0;
            $a_crfi1_m = 0;
            $a_crfi1_f = 0;
            $a_crfi2 = 0;
            $a_cfa1 = 0;
            $a_cfa2_m = 0;
            $a_cfa2_f = 0;
            $a_cfa6 = 0;
            $a_ciss = 0;
            $a_cfa7_m = 0;
            $a_cfa7_f = 0;
            $a_cfa5 = 0;
            $a_cfa4 = 0;
            $a_bafra2 = 0;
            $a_bafra3 = 0;
            $a_bafra5 = 0;
            $a_cfa3 = 0;
            $a_befra = 0;
            $a_basg = 0;
            $a_brimoto13 = 0;
            $a_bn1 = 0;
            $a_bmi5 = 0;
            $a_rrc12 = 0;
            $a_gar7 = 0;
            $a_bgenie1 = 0;
            $a_gar23 = 0;
            $a_gt1 = 0;
            $a_gec1 = 0;
            $a_sntl = 0;
            $a_gt = 0;
            $a_bon = 0;
        @endphp
        <div class="box box-primary">
            <div class="box-body">
                <div class="table-responsive">
                    @include('situations.journaliere.table')
                </div>

            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <div class="col-md-12">
                    <div class="box">
                        <div id="chart"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="{{ URL::asset('assets/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ URL::asset('assets/js/datatables/dataTables.buttons.min.js') }}"></script>
    {{-- <script src="{{ URL::asset('assets/js/datatables/jszip.min.js') }}"></script>
    <script src="{{ URL::asset('assets/js/datatables/pdfmake.min.js') }}"></script>
    <script src="{{ URL::asset('assets/js/datatables/vfs_fonts.js') }}"></script> --}}
    <script src="{{ URL::asset('assets/js/datatables/buttons.html5.min.js') }}"></script>
    <script src="{{ URL::asset('assets/js/datatables/buttons.print.min.js') }}"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('#globale-table').DataTable({
                dom: 'Bfrtip',
                "order": [
                    [0, "desc"]
                ],
                buttons: [
                    'copy', 'csv', 'excel', 'pdf', 'print'
                ],
                "scrollX": true,
                "paging": false,
                "info": false
            });

            $('#globale-table tfoot th').each(function() {
                let title = $(this).text();
                $(this).html('<input type="search" placeholder="' + title + '" />');
            });
        });
    </script>

    <script src="{{ asset('js\apexcharts1.js') }}"></script>

    <script>
        var _centreLabels = {!! json_encode($centreArray) !!};
        var _c_convoque = {!! json_encode($c_convoque) !!};
        var _c_presente = {!! json_encode($c_presente) !!};
        var _c_admis = {!! json_encode($c_admis) !!};

        var options = {
            series: [{
                name: 'CONVOQUE',
                data: _c_convoque
            }, {
                name: 'PRESENTE',
                data: _c_presente
            }, {
                name: 'ADMIS',
                data: _c_admis
            }],
            chart: {
                type: 'bar',
                height: 350
            },
            plotOptions: {
                bar: {
                    horizontal: false,
                    columnWidth: '75%',
                    endingShape: 'rounded'
                },
            },
            dataLabels: {
                enabled: false
            },
            stroke: {
                show: true,
                width: 2,
                colors: ['transparent']
            },
            xaxis: {
                categories: _centreLabels,

            },
            yaxis: {

            },
            title: {
                text: 'SITUATION JOURNALIERE DES MOUVEMENTS  ',
                offsetX: 15,
                align: 'middle',
            },
            fill: {
                opacity: 1
            },
            tooltip: {
                y: {
                    formatter: function(val) {
                        return val + " assujetis"
                    }
                }
            }
        };

        var chart = new ApexCharts(document.querySelector("#chart"), options);
        chart.render();
    </script>
    <script>
        $(document).ready(function() {
            // Désélectionner toutes les lignes et sélectionner celle cliquée
            $(document).on('click', '#globale-table tr.ligne-cliquable', function() {
                // Retirer la classe 'ligne-selectionnee' de toutes les lignes
                $('#globale-table tr.ligne-cliquable').removeClass('ligne-selectionnee');

                // Ajouter la classe 'ligne-selectionnee' à la ligne cliquée
                $(this).addClass('ligne-selectionnee');
            });
        });
    </script>
@endsection
