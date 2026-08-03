@extends('layouts.apps')

@section('css')
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
        <h1 class="pull-left">DONNEES DU GRAPH DE LA PHASE DE SELECTION</h1>
        <form action="{{route('graphs.selection')}}" method="get">
            <div class="col-sm-2 pull-right">
                <input type="submit" value="Filtrer" class="btn btn-default">
            </div>
            <div class="col-sm-2 pull-right">
                <input name="date" type="date" class="form-control">
            </div>
        </form >
        <button type="button" class="btn btn-success btn-xs pull-right" data-placement="top" title="Ajouter" data-toggle="modal" data-target="#mouvement">
            <i class="fa fa-plus"></i>
        </button>
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
                @include('situations.graphs.selection.table')
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
