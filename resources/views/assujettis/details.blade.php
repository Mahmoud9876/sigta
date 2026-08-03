@extends('layouts.apps')

@section('title', 'ASSUJETTIS')

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
        <h1 class="pull-left">ASSUJETTIS</h1>
        @if(Request::get('view') == 'tablet')
            <a href="{{route('assujettis.index')}}?view=table" rel="tooltip" data-placement="top" title="Journalière" class="btn btn-default pull-right"><span class="fa fa-tablet"></span></a>
        @else
            <a href="{{route('assujettis.index')}}?view=tablet" rel="tooltip" data-placement="top" title="Globale" class="btn btn-default pull-right" ><span class="fa fa-table"></span></a>
        @endif

        <form action="{{route('assujettis.index')}}" method="get">
            <div class="col-sm-2 pull-right">
                <input type="submit" value="Filtrer" class="btn btn-default">
            </div>
            <input type="hidden" name="view" value="table">
            <div class="col-sm-2 pull-right">
                <input name="presentation" type="date" class="form-control">
            </div>
        </form>
    </section>
    <div class="content ">
        <div class="clearfix mt-2"></div>

        <div class="box box-primary">
            <div class="box-body">
              @include('assujettis.table_details')
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
  {{-- <script src="{{URL::asset('assets/js/datatables/pdfmake.min.js')}}"></script> --}}
  {{-- <script src="{{URL::asset('assets/js/datatables/vfs_fonts.js')}}"></script> --}}
  <script src="{{URL::asset('assets/js/datatables/buttons.html5.min.js')}}"></script>
  <script src="{{URL::asset('assets/js/datatables/buttons.print.min.js')}}"></script>
  <script type="text/javascript">
    $(function () {
      $('#assujettis-details-table').DataTable({
          dom: 'Bfrtip',
          "order": [[ 0, "desc" ]],
          buttons: [
              'copy', 'csv', 'excel', 'pdf', 'print'
          ],
          "paging":   false,
          "info":     false
      });
    });
  </script>
@endsection
