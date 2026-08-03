@extends('layouts.apps')

@if (Request::has('date') && !empty(Request::get('date')))
    @section('title', 'CONSOMMATION DES COUPONS DU ' . date('d.m.Y', strtotime(Request::get('date'))))
@else
    @section('title', 'CONSOMMATION DES COUPONS DU ' . now()->format('d.m.Y'))
@endif

@section('css')
    <link rel="stylesheet" href="{{ URL::asset('assets/css/jquery.dataTables.min.css') }}">
    <style>
        div.dt-buttons {
            margin-left: 10px;
            float: right;
        }
    </style>
@endsection

@section('content')
    <section class="content-header">
        <h1 class="pull-left">CONSOMMATION DES COUPONS
            {{ Request::has('date') && !empty(Request::get('date')) ? 'DU ' . date('d.m.Y', strtotime(Request::get('date'))) : '' }}
        </h1>

        <div class="col-sm-12">
            <div class="col-sm-8"></div>
            <div class="col-sm-4">
                <form action="{{ route('situations.coupons') }}" method="get">
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

        <div class="box box-primary">
            <div class="box-body">
                @include('situations.coupons.table')
            </div>
        </div>
        <div class="row">
            <div class="card">
                <div class="card-body">
                    <div class="col-md-12">
                        <div class="box">
                            <div id="chart"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <div class="col-md-12">
                        <div class="box">
                            <div id="chartC"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="{{ URL::asset('assets/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ URL::asset('assets/js/datatables/dataTables.buttons.min.js') }}"></script>
    <script src="{{ URL::asset('assets/js/datatables/jszip.min.js') }}"></script>
    <script src="{{ URL::asset('assets/js/datatables/pdfmake.min.js') }}"></script>
    <script src="{{ URL::asset('assets/js/datatables/vfs_fonts.js') }}"></script>
    <script src="{{ URL::asset('assets/js/datatables/buttons.html5.min.js') }}"></script>
    <script src="{{ URL::asset('assets/js/datatables/buttons.print.min.js') }}"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('#coupons-table').DataTable({
                dom: 'Bfrtip',
                "order": [
                    [0, "desc"]
                ],
                buttons: [
                    'copy', 'csv', 'excel', 'pdf', 'print'
                ],
                "paging": false
            });
        });
    </script>
    {{-- for chart --}}
    <script src="{{ asset('js\apexcharts1.js') }}"></script>

    <script>
        var _centreLabels = {!! json_encode($centreArray) !!};
        var _c_utilise = {!! json_encode($c_utilise) !!};
        var _c_theorique = {!! json_encode($c_theorique) !!};
        var _montantOncf = {!! json_encode($montantOncf) !!};
        var _montantSNTL = {!! json_encode($montantSNTL) !!};
        var _total = {!! json_encode($total) !!};

        var options = {
            series: [{
                name: 'UTILISE',
                data: _c_utilise
            }, {
                name: 'THEORIQUE',
                data: _c_theorique
            }, ],
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
                text: 'CONSOMMATION DES COUPONS ',
                offsetX: 15,
                align: 'middle',
            },
            fill: {
                opacity: 1
            },
            tooltip: {
                y: {
                    formatter: function(val) {
                        return val + " coupons"
                    }
                }
            }
        };

        var chart = new ApexCharts(document.querySelector("#chart"), options);
        chart.render();

        var optionsC = {
            series: [{
                name: 'MONTANT SNTL',
                data: _montantSNTL
            }, {
                name: 'MONTANT ONCF',
                data: _montantOncf
            }, {
                name: 'TOTAL',
                data: _total
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
            colors: [
                '#EF6262',
                '#F3AA60',
                '#468B97', ,
            ],
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
                text: 'REPARTITION DES CONSOMMATION DES COUPONS ',
                offsetX: 15,
                align: 'middle',
            },
            fill: {
                opacity: 1
            },
            tooltip: {
                y: {
                    formatter: function(val1) {
                        return val1 + " DH"
                    }
                }
            }
        };

        var chart = new ApexCharts(document.querySelector("#chartC"), optionsC);
        chart.render();
    </script>
@endsection
