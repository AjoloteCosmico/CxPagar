@extends('adminlte::page')

@section('title', 'PRODUCTO')

@section('content_header')
    <h1 class="font-bold"><i class="fas fa-tag"></i>&nbsp; Producto</h1>
@stop

@section('content')
    <div class="container bg-gray-300 shadow-lg rounded-lg">
        <div class="row rounded-b-none rounded-t-lg shadow-xl bg-white">
            <h5 class="card-title p-2">
                <i class="fas fa-plus-circle"></i>&nbsp; Agregar Producto:
            </h5>
        </div>
        <form action="{{ route('products.store')}}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row rounded-b-lg rounded-t-none mb-4 shadow-xl bg-gray-300">
            <div class="row p-4">
                <div class="col-sm-12 col-xs-12 shadow rounded-xl p4">
                    <div class="card">
                        <div class="card-body">
                            <div class="form-group">
                                <x-jet-label value="* Producto" />
                                <x-jet-input type="text" name="product" class="w-full text-xs " value="{{old('product')}}"/>
                                <x-jet-input-error for='product' />
                            </div>
                            <div class="form-group">
                                <x-jet-label value="SKU" />
                                <x-jet-input type="text" name="sku" class="w-full text-xs " value="{{old('sku')}}"/>
                                <x-jet-input-error for='sku' />
                            </div>
                            <div class="form-group">
                                <x-jet-label value="Familia" />
                                <x-jet-input type="text" name="family" class="w-full text-xs " value="{{old('family')}}"/>
                                <x-jet-input-error for='family' />
                            </div>
                            <div class="form-group">
                                <x-jet-label value="* Retenciones" />
                                <x-jet-input type="number" step="0.01" name="tax" class="w-full text-xs " value="{{old('tax')}}"/>
                                <x-jet-input-error for='tax' />
                            </div>
                            
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 text-right p-2 gap-2">
                <a href="{{ route('coins.index')}}" class="btn btn-black mb-2">
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

@stop