@extends('adminlte::page')

@section('title', 'PROVEEDORES')

@section('content_header')
    <h1 class="font-bold"><i class="fas fa-users-cog"></i>&nbsp; PROVEEDORES</h1>
@stop

@section('content')
    <div class="container bg-gray-300 shadow-lg rounded-lg">
        <div class="row rounded-b-none rounded-t-lg shadow-xl bg-white">
            <h5 class="card-title p-2">
                <i class="fas fa-plus-circle"></i>&nbsp; Agregar PROVEEDOR:
            </h5>
        </div>
        <form action="{{ route('providers.rfc')}}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row rounded-b-lg rounded-t-none mb-4 shadow-xl bg-gray-300">
            <div class="row p-4">
                <div class="col-sm-6 col-xs-12 shadow rounded-xl p4">
                    <div class="card">
                        <div class="card-header">
                            <h1 class="h5 text-center fw">Ingrese el RFC del nuevo proveedor</h1>
                        </div>
                        <div class="card-body">
                            
                            <div class="form-group">
                                <x-jet-label value="* RFC" />
                                <x-jet-input type="text" name="customer_rfc" class="w-full text-lg " value="{{old('customer_rfc')}}" onkeyup="javascript:this.value=this.value.toUpperCase();"/>
                                <x-jet-input-error for='customer_rfc' />
                            </div>
                            
                        </div>
                    </div>
                </div>
                
                    </div>
                </div>
            </div>
            <div class="col-12 text-right p-2 gap-2">
                <a href="{{ route('providers.index')}}" class="btn btn-black mb-2">
                    <i class="fas fa-times fa-2x"></i>&nbsp;&nbsp; Cancelar
                </a>
                <button type="submit" class="btn btn-green mb-2">
                    <i class="fas fa-save fa-2x"></i>&nbsp; &nbsp; Guardar
                </button>
            </div>
        </div>
        </form>
    </div>
@stop

@section('css')
    
@stop

@section('js')
<script>
    $(document).ready(function () {     
$('#legal_name').change(function(){
var seleccionado = $(this).val();
if(seleccionado=='otra'){
document.getElementById('otra').style.display="block";
}
else{
    document.getElementById('otra').style.display="none"; 
}

})
});
</script>
@stop