@extends('adminlte::page')

@section('title', 'GASTOS FIJOS POR PERIODO')

@section('content_header')
    <h1 class="font-bold"><i class="fa-solid fa-clipboard-check"></i>&nbsp; GASTOS FIJOS POR PERIODO</h1>
    <script src="/Scripts/jquery.dataTables.js"></script>
<script src="/Scripts/dataTables.bootstrap.js"></script>
    
@stop

@section('content')
    <div class="container-flex m-1 bg-gray-300 shadow-lg rounded-lg">
        <div class="row p-3 m-2 rounded-lg shadow-xl bg-white">
            <div class="col-sm-12 text-right">
            
                @can('CREAR PEDIDOS')
                <a href="{{ route('bills.create')}}" class="btn btn-green">
                    <i class="fa-solid fa-plus-circle"></i>&nbsp; Nuevo
                </a>
                @endcan
            </div>
            <div class="w-100">&nbsp;</div>
            <div class="col-6 col-sm-12 table-responsive">
                <table class="table table-striped text-xs font-medium" id="t">
                    <thead>
                        <tr class="text-center">
                            <th>PERIODO</th>
                            <th>CORPORATIVO</th>
                            <th>PLANTA</th>
                            <th>TOTAL</th>
                            <th>% DEL TOTAL</th>
                            
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($BillsPeriods as $row)
                        <tr class="text-center">
                            <td>{{$row->id}}</td>
                            <td>{{$row->description}}</td>
                            <td>$ {{number_format($row->p_total,2)}}</td>
                            <td class="w-15">
                                <div class="row">
                                    <div class="col-3 text-center">
                                        @can('VER PEDIDOS')
                                        <a class="btn btn-blue" href="{{ route('bills.show', $row->id)}}">
                                            <i class="fa-solid fa-eye"> </i> 
                                        </a>
                                        @endcan
                                    </div>
                                    <div class="col-3 text-center" style="padding:0,5vw">
                                        
                                        @can('BORRAR PEDIDOS')
                                        <form class="DeleteReg" action="{{route('bills.destroy', $row->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-red ">
                                                <i class="fa-solid fa-trash items-center"></i>
                                            </button>
                                        </form>
                                        @endcan
                                        
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
<script type="text/javascript" src="{{ asset('vendor/mystylesjs/js/tablecatalogointernal_orders.js') }}"></script>

<script type="text/javascript" src="{{ asset('vendor/mystylesjs/js/alert_delete_reg.js') }}"></script>

@if (session('create_reg') == 'ok')
<script type="text/javascript" src="{{ asset('vendor/mystylesjs/js/confirm_create_reg.js') }}"></script>
@endif

@if (session('eliminar') == 'ok')
<script type="text/javascript" src="{{ asset('vendor/mystylesjs/js/confirm_delete_reg.js') }}"></script>
@endif

@if (session('error_delete') == 'ok')
<script type="text/javascript" src="{{ asset('vendor/mystylesjs/js/error_delete_reg.js') }}"></script>
@endif

@if (session('update_reg') == 'ok')
<script type="text/javascript" src="{{ asset('vendor/mystylesjs/js/update_reg.js') }}"></script>
@endif


<script>
    new DataTable('#t');
</script>
@stop