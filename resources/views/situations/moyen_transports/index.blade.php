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
        <h1 class="pull-left">REPARTITION DES MOYENS DE TRANSPORT UTILISE POUR ACHEMINER LES ASSUJETTIS DU LR VERS CS
            {{ Request::has('date') && !empty(Request::get('date')) ? 'DU ' . date('d.m.Y', strtotime(Request::get('date'))) : '' }}
        </h1>

        <div class="col-sm-12">
            <div class="col-sm-8"></div>
            <div class="col-sm-4">
                {{--                <form action="{{route('situations.moyen_transports')}}" method="get"> --}}
                {{--                    <div class="col-sm-8"> --}}
                {{--                        <input name="date" type="date" id="date" value="{{Request::has('date') ? Request::get('date') : null}}" class="form-control"> --}}
                {{--                    </div> --}}
                {{--                    <div class="col-sm-4"> --}}
                {{--                        <input type="submit" value="Filtrer" class="btn btn-default"> --}}
                {{--                    </div> --}}
                {{--                </form> --}}
            </div>
        </div>
    </section>
    <div class="content">
        <div class="clearfix  mt-1"></div>

        <div class="box box-primary">
            <div class="box-body">
                @include('situations.moyen_transports.table')
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
        var _c_pm = {!! json_encode($c_pm) !!};
        var _c_navette = {!! json_encode($c_navette) !!};
        var _co_oncf = {!! json_encode($co_oncf) !!};
        var _co_sntl = {!! json_encode($co_sntl) !!};

        var options = {
            series: [{
                name: 'PROPRE MOYEN',
                data: _c_pm
            }, {
                name: 'NAVETTE',
                data: _c_navette
            }, {
                name: 'COUPON ONCF',
                data: _co_oncf
            }, {
                name: 'COUPON VOIE ROUTIERE',
                data: _co_sntl
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
                text: 'REPARTITION DES MOYENS DE TRANSPORT POUR L\'ACHEMINEMENT ',
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
@endsection
