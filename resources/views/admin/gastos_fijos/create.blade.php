@extends('adminlte::page')

@section('title', 'Bienes y servicios ')

@section('content_header')
    <h1 class="font-bold"><i class="fas fa-money-check-alt"></i>&nbsp; Bienes y servicios </h1>
@stop

@section('content')
    <div class="container bg-gray-300 shadow-lg rounded-lg">
        <div class="row rounded-b-none rounded-t-lg shadow-xl bg-white">
            <h5 class="card-title p-2">
                <i class="fas fa-plus-circle"></i>&nbsp; Agregar Bien o Servicio:
            </h5>
        </div>
        <form action="{{ route('gastos_fijos.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row rounded-b-lg rounded-t-none mb-4 shadow-xl bg-gray-300">
                <div class="col-12 p-4">
                    <div class="card shadow-sm rounded-lg">
                        <div class="card-header bg-white">
                            <h5 class="mb-0 font-weight-bold"><i class="fas fa-info-circle"></i> Datos generales</h5>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6 form-group">
                                    <x-jet-label value="* Tipo de bien" />
                                    <select name="type" class="form-control w-full text-xs uppercase" required>
                                        <option value="">Seleccione...</option>
                                        <option value="productos" {{ old('type', $selectedType) == 'productos' ? 'selected' : '' }}>productos</option>
                                        <option value="servicios" {{ old('type', $selectedType) == 'servicios' ? 'selected' : '' }}>servicios</option>
                                        <option value="integracion" {{ old('type', $selectedType) == 'integracion' ? 'selected' : '' }}>integracion</option>
                                        <option value="gastos_fijos" {{ old('type', $selectedType) == 'gastos_fijos' ? 'selected' : '' }}>gastos fijos</option>
                                    </select>
                                    <x-jet-input-error for='type' />
                                </div>
                                <div class="col-md-6 form-group">
                                    <x-jet-label value="* Descripción" />
                                    <x-jet-input type="text" name="description" class="w-full text-xs" value="{{ old('description') }}" maxlength="100" onkeyup="javascript:this.value=this.value.toUpperCase();"/>
                                    <x-jet-input-error for='description' />
                                </div>
                                <div class="col-md-6 form-group">
                                    <x-jet-label value="* Monto" />
                                    <x-jet-input type="number" step="0.01" min="0.01" name="amount" class="w-full text-xs" value="{{ old('amount') }}" />
                                    <x-jet-input-error for='amount' />
                                </div>
                                <div class="col-md-6 form-group">
                                    <x-jet-label value="* Moneda" />
                                    <select name="coin_id" class="form-control w-full text-xs select2" required>
                                        <option value="">Seleccione...</option>
                                        @foreach ($Coins as $coin)
                                            <option value="{{ $coin->id }}" @if (old('coin_id') == $coin->id) selected @endif>
                                                {{ $coin->coin }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <x-jet-input-error for='coin_id' />
                                </div>
                                <div class="col-md-6 form-group">
                                    <x-jet-label value="* Periodicidad" />
                                    <select name="periodicity" class="form-control w-full text-xs uppercase" required>
                                        <option value="">Seleccione...</option>
                                        <option value="SEMANAL" {{ old('periodicity') == 'SEMANAL' ? 'selected' : '' }}>SEMANAL</option>
                                        <option value="MENSUAL" {{ old('periodicity') == 'MENSUAL' ? 'selected' : '' }}>MENSUAL</option>
                                        <option value="BIMESTRAL" {{ old('periodicity') == 'BIMESTRAL' ? 'selected' : '' }}>BIMESTRAL</option>
                                        <option value="SEMESTRAL" {{ old('periodicity') == 'SEMESTRAL' ? 'selected' : '' }}>SEMESTRAL</option>
                                        <option value="ANUAL" {{ old('periodicity') == 'ANUAL' ? 'selected' : '' }}>ANUAL</option>
                                    </select>
                                    <x-jet-input-error for='periodicity' />
                                </div>
                                
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-12 text-right p-2 gap-2">
                    <a href="{{ route('gastos_fijos.index') }}" class="btn btn-black mb-2">
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
            $('.select2').select2({
                placeholder: 'Seleccione...',
                allowClear: true,
                width: '100%'
            });
        });
    </script>
@stop
