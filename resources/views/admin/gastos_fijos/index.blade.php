@extends('adminlte::page')

@section('title', 'INVENTARIO DE PRODUCTOS Y SERVICIOS')

@section('content_header')
    <h1 class="font-bold">
        <i class="fas fa-money-check-alt"></i>&nbsp;INVENTARIO DE PRODUCTOS Y SERVICIOS
    </h1>
@stop

@section('content')
    <div class="container-flex m-1 bg-gray-300 shadow-lg rounded-lg">
        <div class="row p-3 m-2 rounded-lg shadow-xl bg-white">
            <div class="col-sm-12 text-right">
                <a href="{{ route('gastos_fijos.create') }}" class="btn btn-green">
                    <i class="fas fa-plus-circle"></i>&nbsp; Nueva
                </a>
            </div>
            <div class="w-100">&nbsp;</div>

            @php
                // Definimos las pestañas: slug (id HTML) => label visible
                // El slug se compara contra el campo `type` de forma flexible
                // (se normaliza a minúsculas y espacios -> guion bajo).
                $tipos = [
                    'productos'    => ['label' => 'Productos',    'icon' => 'fas fa-box'],
                    'servicios'    => ['label' => 'Servicios',    'icon' => 'fas fa-concierge-bell'],
                    'integracion'  => ['label' => 'Integración',  'icon' => 'fas fa-plug'],
                    'gastos_fijos' => ['label' => 'Gastos Fijos', 'icon' => 'fas fa-file-invoice-dollar'],
                ];
            @endphp

            <div class="col-sm-12">
                {{-- Pestañas estilo AdminLTE (nav-tabs de Bootstrap 4) --}}
                <ul class="nav nav-tabs" id="inventarioTabs" role="tablist">
                    @foreach($tipos as $slug => $info)
                        <li class="nav-item" role="presentation">
                            <a class="nav-link {{ $loop->first ? 'active' : '' }}"
                               id="tab-{{ $slug }}"
                               data-toggle="tab"
                               href="#pane-{{ $slug }}"
                               role="tab"
                               aria-controls="pane-{{ $slug }}"
                               aria-selected="{{ $loop->first ? 'true' : 'false' }}">
                                <i class="{{ $info['icon'] }}"></i>&nbsp;{{ $info['label'] }}
                            </a>
                        </li>
                    @endforeach
                </ul>

                <div class="tab-content pt-3" id="inventarioTabsContent">
                    @foreach($tipos as $slug => $info)
                        @php
                            // Filtrado flexible: "Gastos Fijos", "gastos fijos", "GASTOS_FIJOS", etc.
                            $items = $gastosFijos->filter(function ($item) use ($slug) {
                                $type = strtolower(str_replace(' ', '_', (string) $item->type));
                                return $type === strtolower($slug);
                            });
                        @endphp

                        <div class="tab-pane fade {{ $loop->first ? 'show active' : '' }}"
                             id="pane-{{ $slug }}"
                             role="tabpanel"
                             aria-labelledby="tab-{{ $slug }}">

                            <div class="table-responsive">
                                <table class="table table-striped text-xs font-medium datatable-inventario"
                                       id="table-{{ $slug }}"
                                       style="width:100%">
                                    <thead>
                                        <tr class="text-center">
                                            <th>ID</th>
                                            <th>Descripción</th>
                                            <th>Monto</th>
                                            <th>Moneda</th>
                                            <th>Periodicidad</th>
                                            <th data-orderable="false" data-searchable="false"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($items as $row)
                                            <tr class="text-center">
                                                <td>{{ $row->id }}</td>
                                                <td>{{ $row->description }}</td>
                                                <td>{{ number_format($row->amount, 2) }}</td>
                                                <td>{{ $row->coin ? $row->coin->coin : 'N/A' }}</td>
                                                <td>{{ $row->periodicity }}</td>
                                                <td class="w-15">
                                                    <div class="row">
                                                        <div class="col-6 text-center">
                                                            <a href="{{ route('gastos_fijos.edit', $row->id) }}">
                                                                <button type="button" class="btn btn-blue">
                                                                    <i class="fas fa-xl fa-edit"></i>
                                                                </button>
                                                            </a>
                                                        </div>
                                                        <div class="col-6 text-center">
                                                            <form class="DeleteReg"
                                                                  action="{{ route('gastos_fijos.destroy', $row->id) }}"
                                                                  method="POST">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit" class="btn btn-red">
                                                                    <i class="fas fa-trash items-center fa-xl"></i>
                                                                </button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        @empty
                                            {{-- DataTables mostrará "No se encontraron resultados" --}}
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@stop

@section('css')
    {{-- DataTables + Buttons (Bootstrap 4). Si activas el plugin desde
         config/adminlte.php puedes quitar los dos <link> de DataTables base. --}}
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.8/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.2/css/buttons.bootstrap4.min.css">

    <style>
        /* Pequeño ajuste para que las pestañas no se peguen al contenido */
        #inventarioTabs .nav-link {
            font-weight: 600;
            color: #495057;
        }
        #inventarioTabs .nav-link.active,
        #inventarioTabs .nav-item.show .nav-link {
            background-color: #007bff;
            border-color: #007bff;
            color: #ffffff;
        }
        .datatable-inventario td .btn {
            padding: .25rem .5rem;
        }
    </style>
@stop

@section('js')
    <script type="text/javascript" src="{{ asset('vendor/mystylesjs/js/alert_delete_reg.js') }}"></script>

    {{-- DataTables core --}}
    <script src="https://cdn.datatables.net/1.13.8/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.8/js/dataTables.bootstrap4.min.js"></script>

    {{-- Buttons + dependencias (Excel / Print) --}}
    <script src="https://cdn.datatables.net/buttons/2.4.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.bootstrap4.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.print.min.js"></script>

    <script>
        $(document).ready(function () {

            // ---- Configuración común para las 4 tablas ----
            const dtOptions = {
                responsive: true,
                dom: 'Bfrtilp',
                buttons: [
                    {
                        extend: 'excelHtml5',
                        text: '<i class="fas fa-file-excel"></i> ',
                        titleAttr: 'Exportar a Excel',
                        className: 'btn btn-green'
                    },
                    {
                        extend: 'print',
                        text: '<i class="fa fa-print"></i> ',
                        titleAttr: 'Imprimir',
                        className: 'btn btn-blue'
                    }
                ],
                language: {
                    sProcessing: "Procesando...",
                    sLengthMenu: "Mostrar _MENU_ registros",
                    sZeroRecords: "No se encontraron resultados",
                    sEmptyTable: "Ningún dato disponible en esta tabla",
                    sInfo: "Registros del _START_ al _END_ de _TOTAL_ registros",
                    sInfoEmpty: "Registros del 0 al 0 de 0 registros",
                    sInfoFiltered: "(filtrado de un total de _MAX_ registros)",
                    sSearch: "Buscar:",
                    sInfoThousands: ",",
                    sLoadingRecords: "Cargando...",
                    oPaginate: {
                        sFirst: "Primero",
                        sLast: "Último",
                        sNext: "Siguiente",
                        sPrevious: "Anterior"
                    },
                    oAria: {
                        sSortAscending: ": Activar para ordenar la columna de manera ascendente",
                        sSortDescending: ": Activar para ordenar la columna de manera descendente"
                    },
                    buttons: {
                        copy: "Copiar",
                        colvis: "Visibilidad"
                    }
                }
            };

            // Inicializar SOLO la primera tabla (la visible) al cargar.
            // Las demás se inicializan al mostrarse (lazy), evitando warnings
            // de column widths en tablas ocultas.
            const tables = {}; // { slug: DataTable instance }

          function initTable(slug) {
    const selector = '#table-' + slug;

            // Si ya existe una DataTable (creada por datatable_gral.js u otro script),
            // la destruimos para evitar el error "Cannot reinitialise".
            if ($.fn.dataTable.isDataTable(selector)) {
                $(selector).DataTable().destroy();
            }

            // Creamos la instancia con TUS opciones.
            tables[slug] = $(selector).DataTable(dtOptions);
        }

            // Inicializa la pestaña activa al cargar
            const $activeTab = $('#inventarioTabs .nav-link.active');
            if ($activeTab.length) {
                initTable($activeTab.attr('href').replace('#pane-', ''));
            }

            // Al cambiar de pestaña, inicializa (si hace falta) y recalcula
            $('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
                const slug = $(e.target).attr('href').replace('#pane-', '');
                initTable(slug);
            });

            // ---- Confirmación de borrado ----
            $(document).on('submit', '.DeleteReg', function (e) {
                if (!confirm('¿Deseas eliminar este registro?')) {
                    e.preventDefault();
                }
            });
        });
    </script>
@stop