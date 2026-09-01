
@extends('layouts.apps')
@section('title', 'ASSUJETTIS')

@section('css')
    <link rel="stylesheet" href="{{ URL::asset('assets/css/jquery.dataTables.min.css') }}">

    <style>
        /* Ligne avec admis = true */
.ligne-admis-true {
    background-color: #4ef876 !important; /* Vert clair */
}

/* Ligne avec admis = false */
.ligne-admis-false {
    background-color: #f08a93 !important; /* Rouge clair */
}
        div.dt-buttons {
            margin-left: 10px;
            float: right;
        }

        /* Style moderne pour le tableau */
        #assujettis-table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
            overflow: hidden;
        }

        #assujettis-table thead {
            background: linear-gradient(135deg, #6e8efb, #a777e3);
            color: white;
            font-weight: 600;
            text-transform: uppercase;
            font-size: 1.35rem;
            letter-spacing: 0.5px;
        }

        #assujettis-table th {
            padding: 15px 12px;
            text-align: left;
            position: relative;
        }

        #assujettis-table th:not(:last-child):after {
            content: "";
            position: absolute;
            right: 0;
            top: 15%;
            height: 70%;
            width: 1px;
            background: rgba(255, 255, 255, 0.3);
        }

        #assujettis-table tbody tr {
            transition: all 0.2s ease;
            background-color: white;
        }

        #assujettis-table tbody tr:hover {
            background-color: #f8f9fa;
            transform: translateX(2px);
        }

        #assujettis-table td {
            padding: 12px;
            border-bottom: 1px solid #e9ecef;
            color: #495057;
        }

        #assujettis-table tbody tr:last-child td {
            border-bottom: none;
        }

        /* Effet de ligne sélectionnée */
        #assujettis-table tbody tr.selected {
            background-color: #e3f2fd;
            box-shadow: inset 3px 0 0 #2196f3;
        }

        /* Style pour les cellules */
        #assujettis-table td {
            position: relative;
        }

        /* Effet de zoom au survol */
        #assujettis-table tbody tr:hover td {
            transform: scale(1.01);
        }

        /* Responsive */
        @media (max-width: 768px) {
            #assujettis-table {
                display: block;
                overflow-x: auto;
            }
        }
</style>
@endsection

@section('content')
    <section class="content-header">
        <h1 class="pull-left">ASSUJETTIS</h1>
        @if (!Request::get('view') || Request::get('view') == 'tablet')
            <a href="{{ route('assujettis.index') }}?view=table" rel="tooltip" data-placement="top" title="Journalière"
                class="btn btn-default pull-right"><span class="fa fa-tablet"></span></a>
        @else
            <a href="{{ route('assujettis.index') }}?view=tablet" rel="tooltip" data-placement="top" title="Globale"
                class="btn btn-default pull-right"><span class="fa fa-table"></span></a>
        @endif

    </section>
    <div class="content">
        <div class="clearfix"></div>

        <div class="clearfix"></div>
        <div class="box box-primary">
            <div class="box-body">
                @include('assujettis.table')
            </div>
        </div>
        <div class="text-center">

        </div>
    </div>
@endsection

@section('css')

@endsection
@section('scripts')
<script>
    // Sélection de ligne avec effet
    document.querySelectorAll('#tt-table tbody tr').forEach(row => {
        row.addEventListener('click', function() {
            // Retirer la classe selected de toutes les lignes
            document.querySelectorAll('#tt-table tbody tr').forEach(r => {
                r.classList.remove('selected');
            });
            // Ajouter la classe selected à la ligne cliquée
            this.classList.add('selected');
        });
    });
</script>
<script>
      $(document).ready(function() {
        $('.select2').select2();
    });
</script>
    <script src="{{ URL::asset('assets/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ URL::asset('assets/js/datatables/dataTables.buttons.min.js') }}"></script>
    <script src="{{ URL::asset('assets/js/datatables/jszip.min.js') }}"></script>

    {{-- <script src="{{ URL::asset('assets/js/datatables/pdfmake.min.js') }}"></script> --}}
    {{-- <script src="{{ URL::asset('assets/js/datatables/vfs_fonts.js') }}"></script> --}}
    <script src="{{ URL::asset('assets/js/datatables/buttons.html5.min.js') }}"></script>
    <script src="{{ URL::asset('assets/js/datatables/buttons.print.min.js') }}"></script>
<script>

$(document).ready(function() {
    $('#ville_depart, #ville_arrivee').on('change', function() {
        var villeDepart = $('#ville_depart').val();
        var villeArrivee = $('#ville_arrivee').val();
        var moyenUtilise = $('#vers_selection').val();
        var assujetti = $('#assujetti').val();

        if (moyenUtilise === 'ONCF' && villeDepart && villeArrivee) {
            $.ajax({
                url: '/get-tarif',  // URL de la route Laravel
                method: 'GET',
                data: {
                    assujetti:assujetti,
                    ville_depart: villeDepart,
                    ville_arrivee: villeArrivee
                },
                success: function(response) {
                    $('#prix').val(response.prix_oncf);  // Mettre à jour l'input avec le prix
                },
                error: function(xhr, status, error) {
                    console.error('Erreur:', error);
                    $('#prix').val(0);
                }
            });
        } else {
            $('#prix').val('');  // Réinitialiser l'input si les villes ne sont pas toutes deux sélectionnées
        }
    });
});
</script>


    <script type="text/javascript">
        const demandeIndexUrl = '{{ route('assujettis.index') }}'

        $(function() {
            var table= $('#assujettis-table').DataTable({
                "createdRow": function(row, data, dataIndex) {
            // Vérifie si admis est true/false (gère différents formats)
            const admis = data.admis;
            const isTrue = admis === true || admis === 'true' || admis === 1 || admis === '1';
            const isFalse = admis === false || admis === 'false' || admis === 0 || admis === '0';

            // Applique les classes CSS seulement si la valeur est définie
            if (isTrue) {
                $(row).addClass('ligne-admis-true');
            } else if (isFalse) {
                $(row).addClass('ligne-admis-false');
            }
            // Si null/undefined, ne rien faire
        },
                dom: 'Bfrtip',

                buttons: [
                    'copy', 'csv', 'excel', 'pdf', 'print',
                ],
                "order": [
                    [3, "asc"]
                ],

                "processing": true,
                "serverSide": true,
                "ajax": {
                    url: demandeIndexUrl
                },
                columns: [{
                        data: 'cnie',
                        name: 'cnie'
                    },
                    {
                        data: 'nom',
                        name: 'nom'
                    },
                    {
                        data: 'sexe',
                        name: 'sexe'
                    },
                    {
                        data: 'convocation',
                        name: 'convocation'
                    },
                    {
                        data: 'presentation',
                        name: 'presentation'
                    },
                    {
                        data: 'selection',
                        name: 'selection'
                    },
                    {
                        data: 'admis',
                        name: 'admis',
                    },
                    {
                        data: 'formation',
                        name: 'formation'
                    },

                    {
                        data: 'vers_selection',
                        name: 'vers_selection',
                        visible: true
                    },
                    {
                        data: 'vers_formation',
                        name: 'vers_formation',
                        visible: true
                    },
                    {
                        data: 'domicile',
                        name: 'domicile',
                        visible: true
                    },
                    {
                        data: function() {
                            let $show = ''

                            $show =
                                '<button type="button" class="btn btn-success btn-xs" data-placement="top" title="visualiser" data-toggle="modal" data-target="#assujetti">' +
                                '<i class="fa fa-eye"></i>' +
                                '</button>'

                            return $show
                        },
                        orderable: false,
                        searchable: false,
                    }
                ],

            });

        });




        $(document).ready(function() {
            $('#assujettis-table tfoot th').each(function() {
                let title = $(this).text();
                $(this).html('<input type="text" placeholder="' + title + '" />');
            });

            let table = $('#assujettis-table').DataTable();

            $('#assujettis-table tbody').on('click', 'tr', function() {
                let row = table.row(this).data()
                $('#identite').text(row.cnie)
                $('#cnie').text(row.cnie)
                $('#nom').text(row.nom)
                $('#adresse').text(row.adresse)
                $('#commune').text(row.commune)
                $('#province').text(row.province)
                $('#convocation').html(row.convocation)
                $('#presentation').val(row.presentation)
                $('#transport').val(row.transport)
                $('#presentation').data('previous', row.presentation)
                $('#transport').data('previous', row.transport)
                $('#selection').html(row.selection)
                $('#formation').val(row.formation).trigger('change.select2')
                if (row.coupons == true) {
                    $('#coupons').val(1).trigger('change.select2')
                } else if (row.coupons == false) {
                    $('#coupons').val(0).trigger('change.select2')
                } else {
                    $('#coupons').val("").trigger('change.select2')
                }
                if (row.admis == true) {
                    $('#admis').val(1).trigger('change.select2')
                } else if (row.admis == false) {
                    $('#admis').val(0).trigger('change.select2')
                } else {
                    $('#admis').val("").trigger('change.select2')
                }
                if (row.vers_formation != null) {
                    $('#vers_formation').val(row.vers_formation).trigger('change.select2')
                } else {
                    $('#vers_formation').val("").trigger('change.select2')
                }
                if (row.domicile != null) {
                    $('#domicile').val(row.domicile).trigger('change.select2')
                } else {
                    $('#domicile').val("").trigger('change.select2')
                }
                $('#vers_selection').val(row.vers_selection).trigger('change.select2')
                $('#trajet').val(row.trajet)
                $('#ville_depart').val(row.ville_depart).trigger('change.select2')
                $('#ville_arrivee').val(row.ville_arrivee).trigger('change.select2')

                $('#prix').val(row.prix)
                $('#assujetti').val(row.id)

                // $('#prix_label').html(row.prix)
                // $('#trajet_label').html(row.trajet)
                // $('#selection_label').html(row.selection)
                // $('#formation_label').html(row.formation)
                // $('#vers_formation_label').html(row.vers_formation)
                // $('#vers_selection_label').html(row.vers_selection)

                if (row.presentation == null) {
                    $('#presentation_check').attr('src', '/images/unckeck.jpg')
                } else {
                    $('#presentation_check').attr('src', '/images/check.png')
                }
                if (row.formation == null) {
                    $('#formation_check').attr('src', '/images/unckeck.jpg')
                } else {
                    $('#formation_check').attr('src', '/images/check.png')
                }
                if (row.coupons == null) {
                    $('#coupons_check').attr('src', '/images/unckeck.jpg')
                } else if (row.coupons == true && (row.ville_depart == null|| row.ville_arrivee == null || row.prix == null)) {
                    $('#coupons_check').attr('src', '/images/unckeck.jpg')
                } else {
                    $('#coupons_check').attr('src', '/images/check.png')
                }
                if (row.vers_selection == null) {
                    $('#vers_selection_check').attr('src', '/images/unckeck.jpg')
                } else {
                    $('#vers_selection_check').attr('src', '/images/check.png')
                }
                if (row.transport == null) {
                    $('#transport_check').attr('src', '/images/unckeck.jpg')
                } else {
                    $('#transport_check').attr('src', '/images/check.png')
                }
                if (row.admis == null) {
                    $('#admis_check').attr('src', '/images/unckeck.jpg')
                } else {
                    $('#admis_check').attr('src', '/images/check.png')
                }
                if (row.vers_formation == null) {
                    $('#vers_formation_check').attr('src', '/images/unckeck.jpg')
                } else {
                    $('#vers_formation_check').attr('src', '/images/check.png')
                }
                if (row.domicile == null) {
                    $('#domicile_check').attr('src', '/images/unckeck.jpg')
                } else {
                    $('#domicile_check').attr('src', '/images/check.png')
                }
            });

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

            $('#presentation').on('change', function() {
                id = $('#assujetti').val()
                var value = $('#presentation').val()
                if (!isValidDateRange(value)) {
                    alert('La date doit être comprise entre le 01/09 et le 30/09/' + new Date().getFullYear());
                    $('#presentation').val($('#presentation').data('previous'));
                    return;
                }
                var data = new FormData();
                data.append('id', id);
                data.append('value', value);
                data.append('field', 'presentation');

                send(data, 'presentation', table)
            })

            $('#formation').on('change', function() {
                id = $('#assujetti').val()
                var data = new FormData();
                data.append('id', id);
                data.append('value', $('#formation').val());
                data.append('field', 'formation');

                send(data, 'formation', table)
            })

            $('#vers_selection').on('change', function() {
                id = $('#assujetti').val()
                var selectedValue = $('#vers_selection').val();
                var assujetti = $('#assujetti').val();
                var data = new FormData();
                data.append('id', id);
                data.append('value', $('#vers_selection').val());
                data.append('field', 'vers_selection');

                send(data, 'vers_selection', table)
                 // Gestion des prix en fonction de la sélection
    if (selectedValue === 'ONCF') {
        // Requête AJAX pour obtenir le prix ONCF
        var ville_depart = $('#ville_depart').val();
        var ville_arrivee = $('#ville_arrivee').val();

        $.ajax({
            url: '/get-tarif', // URL de ton contrôleur Laravel
            type: 'GET',
            data: {
                assujetti:assujetti,
                ville_depart: ville_depart,
                ville_arrivee: ville_arrivee
            },
            success: function(response) {
                $('#prix').val(response.prix_oncf); // Affiche le prix ONCF dans l'input
            },
            error: function() {
                $('#prix').val('Erreur lors de la récupération du prix'); // En cas d'erreur
            }
        });
    } else if (selectedValue === 'CAR DE LIGNE') {
        $('#prix').val(0); // Affiche 0 pour 'CAR DE LIGNE'
    } else {
        $('#prix').val(''); // Laisse la valeur vide pour les autres sélections
    }
            })

            $('#vers_formation').on('change', function() {
                id = $('#assujetti').val()
                var data = new FormData();
                data.append('id', id);
                data.append('value', $('#vers_formation').val());
                data.append('field', 'vers_formation');

                send(data, 'vers_formation', table)
            })

            $('#coupons').on('change', function() {
                id = $('#assujetti').val()
                var data = new FormData();
                data.append('id', id);
                data.append('value', $('#coupons').val());
                data.append('field', 'coupons');

                send(data, 'coupons', table)
            })
            $('#ville_depart').on('change', function() {
                id = $('#assujetti').val()
                var data = new FormData();
                data.append('id', id);
                data.append('value', $('#ville_depart').val());
                data.append('field', 'ville_depart');
                send(data, 'ville_depart', table)
            })
            $('#ville_arrivee').on('change', function() {
                id = $('#assujetti').val()
                var data = new FormData();
                data.append('id', id);
                data.append('value', $('#ville_arrivee').val());
                data.append('field', 'ville_arrivee');
                send(data, 'ville_arrivee', table)
            })

            $('#admis').on('change', function() {
                id = $('#assujetti').val()
                var data = new FormData();
                data.append('id', id);
                data.append('value', $('#admis').val());
                data.append('field', 'admis');
                console.log('tes1', id, data, $('#admis').val());

                send(data, 'admis', table)
            })

            $('#domicile').on('change', function() {
                id = $('#assujetti').val()
                var data = new FormData();
                data.append('id', id);
                data.append('value', $('#domicile').val());
                data.append('field', 'domicile');

                send(data, 'domicile', table)
            })
        });

        function send(data, field, table) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            });
            $.ajax({
                type: 'POST',
                url: '{{ route('assujettis.fields') }}',
                data: data,
                contentType: false,
                processData: false,

                success: function(response) {
                    if (response == true) {
                        if (field == 'prix' || field == 'ville_depart'|| field == 'ville_arrivee') {
                            $('#coupons_check').attr('src', '/images/check.png')
                        } else {
                            $('#' + field + '_check').attr('src', '/images/check.png')
                        }
                    } else {
                        if (field == 'prix' || field == 'ville_depart'|| field == 'ville_arrivee') {
                            $('#coupons_check').attr('src', '/images/unckeck.jpg')
                        } else {
                            $('#' + field + '_check').attr('src', '/images/unckeck.jpg')
                        }
                    }
                    table.ajax.reload()
                },
                error: function(request) {
                    alert('error: ' + request)
                },
            });
        }

        function isValidDateRange(value) {
            if (!value) {
                return true;
            }
            var year = new Date().getFullYear();
            var min = year + '-09-01';
            var max = year + '-09-30';
            return value >= min && value <= max;
        }

        function update(value, field) {
            console.log(value, field);
            id = $('#assujetti').val()

            if ((field == 'presentation' || field == 'transport') && !isValidDateRange(value)) {
                alert('La date doit être comprise entre le 01/09 et le 30/09/' + new Date().getFullYear());
                $('#' + field).val($('#' + field).data('previous'));
                return;
            }

            var data = new FormData();
            data.append('id', id);
            data.append('value', value);
            data.append('field', field);
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            });
            $.ajax({
                type: 'POST',
                url: '{{ route('assujettis.fields') }}',
                data: data,
                contentType: false,
                processData: false,

                success: function(response) {
                    if (response == true) {
                        if (field == 'prix' || field == 'ville_depart'|| field == 'ville_arrivee') {
                            $('#coupons_check').attr('src', '/images/check.png')
                        } else {
                            $('#' + field + '_check').attr('src', '/images/check.png')
                        }
                    } else {
                        if (field == 'prix' || field == 'ville_depart'|| field == 'ville_arrivee') {
                            $('#coupons_check').attr('src', '/images/unckeck.jpg')
                        } else {
                            $('#' + field + '_check').attr('src', '/images/unckeck.jpg')
                        }
                    }
                },
                error: function(request) {
                    // alert('error: '+request)
                },
            });
        }


    </script>
    <script>
    $(document).ready(function() {
    // Fonction pour afficher les sections basées sur la sélection
    function updateSections() {
        var selectedValue = $('#admis').val();

        // Cache toutes les sections
        $('#formation_section').hide();
        $('#transport_section').hide();
        $('#vers_formation_section').hide();
        $('#domicile_section').hide();

        if (selectedValue == '1') { // Si "ADMIS" est sélectionné
            $('#formation_section').show();
            $('#transport_section').show();
            $('#vers_formation_section').show();
        } else if (selectedValue == '0') { // Si "INAPTE" est sélectionné
            $('#domicile_section').show();

            // Réinitialiser les champs spécifiques pour INAPTE
            clearAndResetField('formation');
            clearAndResetField('transport');
            clearAndResetField('vers_formation');
        } else if (selectedValue == '') { // Si "ADMIS/INAPTE" est sélectionné
            // Réinitialiser tous les champs
            clearAndResetField('formation');
            clearAndResetField('transport');
            clearAndResetField('vers_formation');
            clearAndResetField('domicile');
        }
    }

    // Fonction pour réinitialiser les champs et mettre à jour la base de données
    function clearAndResetField(field) {
        $('#' + field).val('');  // Réinitialise la valeur du champ
        update('', field);       // Met à jour la base de données avec une valeur vide
    }

    // Écouteur d'événement pour le select "admis"
    $('#admis').on('change', function() {
        updateSections();
    });

    // Appelle updateSections lorsque le modal est ouvert
    $('#assujetti').on('shown.bs.modal', function () {
        updateSections();
    });
});
    </script>
@endsection
