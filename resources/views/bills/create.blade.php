@extends('adminlte::page')

@section('title', 'COMPROBANTE DE INGRESO')

@section('content_header')
    <h1 class="font-bold"><i class="fa fa-money"></i>&nbsp;  AGREGAR GASTO FIJO</h1>
@stop

@section('content')
    <div class="container bg-gray-300 shadow-lg rounded-lg">
        <div class="row rounded-b-none rounded-t-lg shadow-xl bg-white">
            <h5 class="card-title p-2">
                <i class="fas fa-plus-circle"></i>&nbsp;   AGREGAR GASTO FIJO
            </h5>
        </div>
        <form action="{{ route('bills.store')}}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row rounded-b-lg rounded-t-none mb-4 shadow-xl bg-gray-300">
            <div class="row p-4">
                <div class="col-sm-12 col-xs-12 shadow rounded-xl p4">
                    <div class="card">
                        <div class="card-body">
                            
                            
                                    
                                    
                                    <div class="form-group">
                                        <x-jet-label value="DESCRIPCION" />
                                        <x-jet-input type="text" name="description"  class="form-control w-full text-xs" value=""  />
                                        <x-jet-input-error for='description' />
                                    </div>

                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 text-right p-2 gap-2">
                  <a href="{{ route('bills.index')}}" class="btn btn-black mb-2">
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


@section('js')

@stop