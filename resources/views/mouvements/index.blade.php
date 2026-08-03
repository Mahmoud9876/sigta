@extends('layouts.apps')

@section('title', 'MOUVEMENTS')

@section('css')
    <link rel="stylesheet" href="{{ URL::asset('assets/css/jquery.dataTables.min.css') }}">
    <style>
        div.dt-buttons {
            margin-left: 10px;
            float: right;
        }
    /* Style moderne et chic pour le tableau */
    #mouvements-table {
        --primary-color: #2a3f54;
        --secondary-color: #6c7a89;
        --accent-color: #e67e22;
        --text-light: #f5f5f5;
        --text-dark: #333333;
        --transition-speed: 0.3s;

        width: 100%;
        border-collapse: separate;
        border-spacing: 0;
        font-family: 'Montserrat', 'Helvetica Neue', Arial, sans-serif;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
        border-radius: 12px;
        overflow: hidden;
        background: linear-gradient(145deg, #ffffff 0%, #f8f9fa 100%);
        margin: 25px 0;
    }

    #mouvements-table thead {
        background: linear-gradient(135deg, var(--primary-color) 0%, #1e2b38 100%);
        color: var(--text-light);
        text-transform: uppercase;
        letter-spacing: 0.8px;
    }

    #mouvements-table thead th {
        padding: 18px 15px;
        font-weight: 600;
        font-size: 1.3rem;
        text-align: left;
        position: relative;
    }

    #mouvements-table thead th:after {
        content: "";
        position: absolute;
        bottom: 0;
        left: 15px;
        right: 15px;
        height: 1px;
        background: rgba(255, 255, 255, 0.2);
    }

    #mouvements-table tbody tr {
        transition: all var(--transition-speed) ease;
        border-bottom: 1px solid rgba(0, 0, 0, 0.03);
    }

    #mouvements-table tbody tr:last-child {
        border-bottom: none;
    }

    #mouvements-table tbody tr:hover {
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
        background-color: white;
    }

    #mouvements-table tbody td {
        padding: 16px 15px;
        color: var(--text-dark);
        font-weight: 400;
        font-size: 1.3rem;
        border-bottom: 1px solid rgba(0, 0, 0, 0.03);
    }

    #mouvements-table tbody tr:nth-child(even) {
        background-color: rgba(0, 0, 0, 0.01);
    }

    #mouvements-table tbody tr:hover td {
        color: var(--primary-color);
    }

    /* Effet sur les cellules */
    #mouvements-table td {
        position: relative;
        transition: color var(--transition-speed) ease;
    }

    #mouvements-table td:hover:before {
        content: "";
        position: absolute;
        left: 0;
        top: 0;
        bottom: 0;
        width: 3px;
        background: var(--accent-color);
    }

    /* Style responsive */
    @media (max-width: 768px) {
        #mouvements-table {
            border-radius: 8px;
        }

        #mouvements-table thead th,
        #mouvements-table tbody td {
            padding: 12px 8px;
            font-size: 0.8rem;
        }
    }

    /* Animation d'entrée */
    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(10px); }
        to { opacity: 1; transform: translateY(0); }
    }

    #mouvements-table tbody tr {
        animation: fadeIn 0.5s ease forwards;
    }

    #mouvements-table tbody tr:nth-child(1) { animation-delay: 0.1s; }
    #mouvements-table tbody tr:nth-child(2) { animation-delay: 0.2s; }
    #mouvements-table tbody tr:nth-child(3) { animation-delay: 0.3s; }
    /* Continuez selon le nombre de lignes */
</style>
@endsection

@section('content')
    <section class="content-header">
        <h1 class="pull-left">MOUVEMENTS</h1>
        <form action="{{ route('mouvements.index') }}" method="get">
            <div class="col-sm-2 pull-right">
                <input type="submit" value="Filtrer" class="btn btn-default">
            </div>
            <div class="col-sm-2 pull-right">
                <input name="date" type="date" class="form-control">
            </div>
        </form>
        <button type="button" class="btn btn-success btn-xs pull-right" data-placement="top" title="Ajouter"
            data-toggle="modal" data-target="#mouvement">
            <i class="fa fa-plus"></i>
        </button>
    </section>
    <div class="content">
        <div class="clearfix mt-1"></div>
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>
                            {{ $error }}
                        </li>
                    @endforeach
                </ul>
            </div>
        @endif

        @if (Session::has('success'))
            <div class="alert alert-success">
                {{ Session::get('success') }}
            </div>
        @endif

        <div class="box box-primary">
            <div class="box-body">
                @include('mouvements.table')
            </div>
        </div>
        <div class="text-center">

        </div>
    </div>
@endsection

@section('scripts')
<script>
    $(document).ready(function() {
    $('#moyenTr').on('change', function() {
        var selectedValue = $(this).val();

        // Cache tous les divs
        $('#prix_div').hide();
        $('#militaire_div').hide();

        // Affiche le div correspondant à la sélection
        if (selectedValue === 'BON') {
            $('#prix_div').show();
        } else if (selectedValue === 'MO/FAR') {
            $('#militaire_div').show();
        }
    });

    // Initialiser l'état des divs au chargement de la page
    var initialValue = $('#moyenTr').val();
    if (initialValue === 'BON') {
        $('#prix_div').show();
    } else if (initialValue === 'MO/FAR') {
        $('#militaire_div').show();
    }
});
</script>

<script>
    $(document).ready(function() {
        $('[id^=moyenEdit-]').on('change', function() {
            var mouvementId = $(this).attr('id').split('-')[1];
            var selectedValueEdit = $(this).val();
            console.log('Valeur sélectionnée:', selectedValueEdit, 'pour le mouvement ID:', mouvementId);

            // Cache tous les divs
            $('#prix_div_edit-' + mouvementId).hide();
            $('#militaire_div_edit-' + mouvementId).hide();

            // Affiche le div correspondant à la sélection
            if (selectedValueEdit === 'BON') {
                $('#prix_div_edit-' + mouvementId).show();
            } else if (selectedValueEdit === 'MO/FAR') {
                $('#militaire_div_edit-' + mouvementId).show();
            }
        });

        // Initialiser l'état des divs au chargement de la page
        $('[id^=moyenEdit-]').each(function() {
            var mouvementId = $(this).attr('id').split('-')[1];
            var initialValueEdit = $(this).val();
            console.log('Valeur initiale:', initialValueEdit, 'pour le mouvement ID:', mouvementId);

            if (initialValueEdit === 'BON') {
                $('#prix_div_edit-' + mouvementId).show();
            } else if (initialValueEdit === 'MO/FAR') {
                $('#militaire_div_edit-' + mouvementId).show();
            }
        });
    });
</script>
    <script src="{{ URL::asset('assets/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ URL::asset('assets/js/datatables/dataTables.buttons.min.js') }}"></script>
    <script src="{{ URL::asset('assets/js/datatables/jszip.min.js') }}"></script>
    <script src="{{ URL::asset('assets/js/datatables/pdfmake.min.js') }}"></script>
    <script src="{{ URL::asset('assets/js/datatables/vfs_fonts.js') }}"></script>
    <script src="{{ URL::asset('assets/js/datatables/buttons.html5.min.js') }}"></script>
    <script src="{{ URL::asset('assets/js/datatables/buttons.print.min.js') }}"></script>
    <script type="text/javascript">
        $(function() {
            $('#mouvements-table').DataTable({
                dom: 'Bfrtip',
                "order": [
                    [1, "desc"]
                ],
                buttons: [
                    'copy', 'csv', 'excel', 'pdf', 'print'
                ],
                "paging": true,
                "info": false
            });
        });

        $(document).ready(function() {
            $('#mouvements-table tfoot th').each(function() {
                let title = $(this).text();
                $(this).html('<input type="text" placeholder="' + title + '" />');
            });

            let table = $('#mouvements-table').DataTable();

            table.columns().every(function() {
                let that = this;
                $('input', this.footer()).on('keyup change', function() {
                    if (that.search() !== this.value) {
                        that
                            .search(this.value)
                            .draw();
                    }
                });
            });
        });
    </script>
@endsection
