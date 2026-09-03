@extends('layouts.apps')

@section('css')
    <meta http-equiv="refresh" content="300">
    <link rel="stylesheet" href="{{URL::asset('assets/css/jquery.dataTables.min.css')}}">
    <style>
        div.dt-buttons {
            margin-left: 10px;
            float: right;
        }
    </style>
@endsection

@section('content')
    <section class="content-header">
        <h1 class="pull-center">Point de situation du {{ now() }}</h1>
        <div class="text-right" style="margin-bottom: 10px;">
            <a href="{{ route('situation.generale.export.excel') }}" class="btn btn-success"><i class="fa fa-file-excel-o"></i> Exporter Excel</a>
            <a href="{{ route('situation.generale.export.word') }}" class="btn btn-primary"><i class="fa fa-file-word-o"></i> Exporter Word</a>
        </div>
    </section>
    <div class="content">
        <div class="clearfix mt-1"></div>
        @if($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>
                            {{$error}}
                        </li>
                    @endforeach
                </ul>
            </div>
        @endif

        @if(Session::has('success'))
            <div class="alert alert-success">
                {{Session::get('success')}}
            </div>
        @endif

        <div class="box box-primary">
            <div class="box-body">
                <table class="table table-responsive table-bordered text-center" >
                    <thead  style="background-color: gainsboro;" style="border: 1px solid black;">
                        <tr style="border: 1px solid black;">
                            <th  class="text-center" rowspan="2">Date de présentation</th>
                            <th  class="text-center"  class="text-center" rowspan="2">Effectif Théorique</th>
                            <th  class="text-center"  class="text-center" rowspan="2">Effectif Présenté</th>
                            <th  class="text-center"  class="text-center" rowspan="2">Effectif Absent</th>
                            <th  class="text-center"  class="text-center" rowspan="2">Admis</th>
                            <th  class="text-center"  class="text-center" colspan="2">Moyens de transport</th>
                            <th  class="text-center"  class="text-center" rowspan="2">Nombre des assujittis</th>
                            <th  class="text-center"  class="text-center" rowspan="2">Total</th>
                        </tr>
                        <tr>
                            <th  class="text-center">Utilisé</th>
                            <th  class="text-center">Prévu</th>
                        </tr>
                    </thead>
                    <tbody>

                        <tr class="">
                            <td class="text-center" rowspan="16">{{ now()->format('Y-m-d') }}</td>
                            <td class="text-center" rowspan="16">{{$effTheoriqueNow}}</td>
                            <td class="text-center" rowspan="16">{{ $effPresenteNow}}</td>
                            <td class="text-center" rowspan="16">{{ $effAdmisNow }}</td>
                            <td class="text-center" rowspan="16">{{ $effAbsentNow }}</td>
                            <td class="text-center" rowspan="4">CAR de Ligne</td>
                            <td>Navette</td>
                            <td class="text-center">{{ $moyenCarPrevuNavette }}</td>
                            <td class="text-center" rowspan="4">{{ $moyenCarUtilise}}</td>
                        </tr>
                        <tr>
                            <td>ONCF</td>
                            <td class="text-center">{{ $moyenCarPrevuOncf }}</td>
                        </tr>
                        <tr>
                            <td>Propre moyen</td>
                            <td class="text-center">{{ $moyenCarPrevuPropreMoyen }}</td>
                        </tr>
                        <tr>
                            <td>Car de Ligne</td>
                            <td class="text-center">{{ $moyenCarPrevuCar }}</td>
                        </tr>
                        <tr>
                            <td rowspan="4">NAVETTE</td>
                            <td>Navette</td>
                            <td class="text-center">{{ $moyenNavettePrevuNavette }}</td>
                            <td class="text-center" rowspan="4">{{ $moyenNavetteUtilise }}</td>
                        </tr>
                        <tr>
                            <td>ONCF</td>
                            <td>{{ $moyenNavettePrevuOncf }}</td>
                        </tr>
                        <tr>
                            <td>Propre moyen</td>
                            <td>{{ $moyenNavettePrevuPropreMoyen }}</td>
                        </tr>
                        <tr>
                            <td>Car de Ligne</td>
                            <td>{{ $moyenNavettePrevuCar }}</td>
                        </tr>
                        <tr>
                            <td rowspan="4">ONCF</td>
                            <td>Navette</td>
                            <td>{{ $moyenOncfPrevuNavette }}</td>
                            <td rowspan="4">{{ $moyenOncfUtilise }}</td>
                        </tr>
                        <tr>
                            <td>ONCF</td>
                            <td>{{ $moyenOncfPrevuOncf }}</td>
                        </tr>
                        <tr>
                            <td>Propre moyen</td>
                            <td>{{ $moyenOncfPrevuPropreMoyen }}</td>
                        </tr>
                        <tr>
                            <td>Car de Ligne</td>
                            <td>{{ $moyenOncfPrevuCar }}</td>
                        </tr>
                        <tr>
                            <td rowspan="4">PROPRE MOYEN</td>
                            <td>Navette</td>
                            <td>{{ $moyenPropreMoyenPrevuNavette }}</td>
                            <td rowspan="4">{{ $moyenPropreMoyenUtilise }}</td>
                        </tr>
                        <tr>
                            <td>ONCF</td>
                            <td>{{ $moyenPropreMoyenPrevuOncf }}</td>
                        </tr>
                        <tr>
                            <td>Propre moyen</td>
                            <td>{{ $moyenPropreMoyenPrevuPropreMoyen }}</td>
                        </tr>
                        <tr>
                            <td>Car de Ligne</td>
                            <td>{{ $moyenPropreMoyenPrevuCar }}</td>
                        </tr>
                        <tr>
                            <td>TOTAL</td>
                            <td align="center">{{ $effTheoriqueNow }}</td>
                            <td align="center">{{ $effPresenteNow }}</td>
                            <td align="center">{{ $effAbsentNow }}</td>
                            <td align="center">{{ $effAdmisNow }}</td>

                        </tr>



                    </tbody>
                </table>
                <br>
                <h2>Situation Globale : <h2>
                    <br>
                <table class="table table-responsive" style="border: 1px solid black;">
                    <thead  style="background-color: gainsboro;" style="border: 1px solid black;">
                        <tr style="border: 1px solid black;">
                            <th  class="text-center" ></th>
                            <th  class="text-center">CONVOQUES</th>
                            <th  class="text-center">PRESENTES</th>
                            <th  class="text-center">ADMIS</th>
                        </tr>
                    </thead>
                    <tbody>
               <tr style="border: 1px solid black;">
                    <th  class="text-center" >TOTAL</th>
                            <th  class="text-center" >{{ $effTheoriqueGlobal }}</th>
                            <th  class="text-center">{{ $effPresenteGlobal }}</th>
                            <th  class="text-center">{{ $effAdmisGlobal }}</th>
                </tr>

                    </tbody>
                </table>
                <table class="table table-responsive table-bordered text-center">
                    <tr>
                        <td rowspan="4">CAR DE LIGNE</td>
                        <td>Navette</td>
                        <td class="text-center">{{ $moyenCarPrevuNavetteGlobal }}</td>
                        <td class="text-center" rowspan="4">{{ $moyenCarUtiliseGlobal }}</td>
                    </tr>
                    <tr>
                        <td>ONCF</td>
                        <td>{{ $moyenCarPrevuOncfGlobal }}</td>
                    </tr>
                    <tr>
                        <td>Propre moyen</td>
                        <td>{{ $moyenCarPrevuPropreMoyenGlobal }}</td>
                    </tr>
                    <tr>
                        <td>Car de Ligne</td>
                        <td>{{ $moyenCarPrevuCarGlobal }}</td>
                    </tr>



                    <tr>
                        <td rowspan="4">NAVETTE</td>
                        <td>Navette</td>
                        <td class="text-center">{{ $moyenNavettePrevuNavetteGlobal }}</td>
                        <td class="text-center" rowspan="4">{{ $moyenNavetteUtiliseGlobal }}</td>
                    </tr>
                    <tr>
                        <td>ONCF</td>
                        <td>{{ $moyenNavettePrevuOncfGlobal }}</td>
                    </tr>
                    <tr>
                        <td>Propre moyen</td>
                        <td>{{ $moyenNavettePrevuPropreMoyenGlobal }}</td>
                    </tr>
                    <tr>
                        <td>Car de Ligne</td>
                        <td>{{ $moyenNavettePrevuCarGlobal }}</td>
                    </tr>
                    <tr>
                        <td rowspan="4">ONCF</td>
                        <td>Navette</td>
                        <td>{{ $moyenOncfPrevuNavetteGlobal }}</td>
                        <td rowspan="4">{{ $moyenOncfUtiliseGlobal }}</td>
                    </tr>
                    <tr>
                        <td>ONCF</td>
                        <td>{{ $moyenOncfPrevuOncfGlobal }}</td>
                    </tr>
                    <tr>
                        <td>Propre moyen</td>
                        <td>{{ $moyenOncfPrevuPropreMoyenGlobal }}</td>
                    </tr>
                    <tr>
                        <td>Car de Ligne</td>
                        <td>{{ $moyenOncfPrevuCarGlobal }}</td>
                    </tr>
                    <tr>
                        <td rowspan="4">PROPRE MOYEN</td>
                        <td>Navette</td>
                        <td>{{ $moyenPropreMoyenPrevuNavetteGlobal }}</td>
                        <td rowspan="4">{{ $moyenPropreMoyenUtiliseGlobal }}</td>
                    </tr>
                    <tr>
                        <td>ONCF</td>
                        <td>{{ $moyenPropreMoyenPrevuOncfGlobal }}</td>
                    </tr>
                    <tr>
                        <td>Propre moyen</td>
                        <td>{{ $moyenPropreMoyenPrevuPropreMoyenGlobal }}</td>
                    </tr>
                    <tr>
                        <td>Car de Ligne</td>
                        <td>{{ $moyenPropreMoyenPrevuCarGlobal }}</td>
                    </tr>
                </table>
            </div>
        </div>
        <div class="text-center">

        </div>
    </div>
@endsection

@section('scripts')
    <script src="{{URL::asset('assets/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{URL::asset('assets/js/datatables/dataTables.buttons.min.js')}}"></script>
    <script src="{{URL::asset('assets/js/datatables/jszip.min.js')}}"></script>
    <script src="{{URL::asset('assets/js/datatables/pdfmake.min.js')}}"></script>
    <script src="{{URL::asset('assets/js/datatables/vfs_fonts.js')}}"></script>
    <script src="{{URL::asset('assets/js/datatables/buttons.html5.min.js')}}"></script>
    <script src="{{URL::asset('assets/js/datatables/buttons.print.min.js')}}"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('#selection-table').DataTable({
                dom: 'Bfrtip',
                "order": [[ 0, "desc" ]],
                buttons: [
                    'copy', 'csv', 'excel', 'pdf', 'print'
                ],
            });

            $('#selection-table tfoot th').each( function () {
                let title = $(this).text();
                $(this).html( '<input type="search" placeholder="'+title+'" />' );
            } );
        });
    </script>

@endsection
