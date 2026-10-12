@extends('adminlte::page')

@section('title', 'GASTOS FIJOS')

@section('content_header')
    <h1 class="font-bold"><i class="fas fa-money-check-alt"></i>&nbsp; Gastos fijos</h1>
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
            <div class="col-sm-12 table-responsive">
                <table class="table table-striped text-xs font-medium">
                    <thead>
                        <tr class="text-center">
                            <th>ID</th>
                            <th>Descripción</th>
                            <th>Monto</th>
                            <th>Moneda</th>
                            <th>Periodicidad</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($gastosFijos as $row)
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
                                            <button class="btn btn-blue">
                                                <i class="fas fa-xl fa-edit"></i>
                                            </button>
                                        </a>
                                    </div>
                                    <div class="col-6 text-center">
                                        <form class="DeleteReg" action="{{ route('gastos_fijos.destroy', $row->id) }}" method="POST">
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
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@stop

@section('css')
@stop

@section('js')
<script type="text/javascript" src="{{ asset('vendor/mystylesjs/js/alert_delete_reg.js') }}"></script>
<script>
    $(document).ready(function() {
        $('.DeleteReg').on('submit', function (e) {
            if (!confirm('¿Deseas eliminar este gasto fijo?')) {
                e.preventDefault();
            }
        });
    });
</script>
@stop
