@extends('adminlte::page')

@section('title', 'PRODUCTO')

@section('content_header')
    <h1 class="font-bold"><i class="fas fa-tag"></i>&nbsp; Producto / Servicio</h1>
@stop

@section('content')
    <div class="container bg-gray-300 shadow-lg rounded-lg">
        <div class="row rounded-b-none rounded-t-lg shadow-xl bg-white">
            <h5 class="card-title p-2">
                <i class="fas fa-edit"></i>&nbsp; Editar Producto:
            </h5>
        </div>
        <form action="{{ route('products.update', $Product->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PATCH')
            <div class="row rounded-b-lg rounded-t-none mb-4 shadow-xl bg-gray-300">
                <div class="col-12 p-4">
                    <div class="card shadow-sm rounded-lg">
                        <div class="card-header bg-white">
                            <h5 class="mb-0 font-weight-bold"><i class="fas fa-info-circle"></i> Datos generales</h5>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6 form-group">
                                    <x-jet-label value="* SKU" />
                                    <x-jet-input type="text" name="sku" class="w-full text-xs" value="{{ old('sku', $Product->sku) }}" />
                                    <x-jet-input-error for='sku' />
                                </div>
                                <div class="col-md-6 form-group">
                                    <x-jet-label value="* TIPO DE BIEN" />
                                    <select name="tipo_bien" class="form-control w-full text-xs uppercase" required>
                                        <option value="">Seleccione...</option>
                                        <option value="PRODUCTO" {{ old('tipo_bien', $Product->tipo_bien ?? '') == 'PRODUCTO' ? 'selected' : '' }}>PRODUCTO</option>
                                        <option value="SERVICIOS" {{ old('tipo_bien', $Product->tipo_bien ?? '') == 'SERVICIOS' ? 'selected' : '' }}>SERVICIOS</option>
                                        <option value="INTEGRACION" {{ old('tipo_bien', $Product->tipo_bien ?? '') == 'INTEGRACION' ? 'selected' : '' }}>INTEGRACION</option>
                                        <option value="GASTOS FIJOS" {{ old('tipo_bien', $Product->tipo_bien ?? '') == 'GASTOS FIJOS' ? 'selected' : '' }}>GASTOS FIJOS</option>
                                        <option value="CONTRIBUCIONES E IMPUESTOS" {{ old('tipo_bien', $Product->tipo_bien ?? '') == 'CONTRIBUCIONES E IMPUESTOS' ? 'selected' : '' }}>CONTRIBUCIONES E IMPUESTOS</option>
                                        <option value="OTRO1" {{ old('tipo_bien', $Product->tipo_bien ?? '') == 'OTRO1' ? 'selected' : '' }}>OTRO1</option>
                                        <option value="OTRO2" {{ old('tipo_bien', $Product->tipo_bien ?? '') == 'OTRO2' ? 'selected' : '' }}>OTRO2</option>
                                        <option value="OTRO3" {{ old('tipo_bien', $Product->tipo_bien ?? '') == 'OTRO3' ? 'selected' : '' }}>OTRO3</option>
                                        <option value="OTRO4" {{ old('tipo_bien', $Product->tipo_bien ?? '') == 'OTRO4' ? 'selected' : '' }}>OTRO4</option>
                                    </select>
                                    <x-jet-input-error for='tipo_bien' />
                                </div>
                                <div class="col-md-6 form-group">
                                    <x-jet-label value="* Producto / Servicio" />
                                    <x-jet-input type="text" name="product" class="w-full text-xs" value="{{ old('product', $Product->product) }}" />
                                    <x-jet-input-error for='product' />
                                </div>
                                <div class="col-md-12 form-group">
                                    <x-jet-label value="* Descripción" />
                                    <textarea name="description" class="form-control w-full text-xs" rows="3">{{ old('description', $Product->description ?? '') }}</textarea>
                                    <x-jet-input-error for='description' />
                                </div>
                                <div class="col-md-6 form-group">
                                    <x-jet-label value="* Familia" />
                                    <x-jet-input type="text" name="family" class="w-full text-xs" value="{{ old('family', $Product->family) }}" />
                                    <x-jet-input-error for='family' />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-12 p-4 pt-0">
                    <div class="card shadow-sm rounded-lg">
                        <div class="card-header bg-white">
                            <h5 class="mb-0 font-weight-bold"><i class="fas fa-dollar-sign"></i> Precio y Control</h5>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-4 form-group">
                                    <x-jet-label value="* Precio público" />
                                    <div class="flex items-center gap-2">
                                        <x-jet-input type="number" step="0.01" min="0.01" name="public_price" class="w-full text-xs" value="{{ old('public_price', $Product->public_price ?? '') }}" />
                                        <span class="text-sm font-semibold">$</span>
                                    </div>
                                    <x-jet-input-error for='public_price' />
                                </div>
                                <div class="col-md-4 form-group">
                                    <x-jet-label value="* Moneda" />
                                    <select name="coin_id" class="form-control w-full text-xs select2" required>
                                        <option value="">Seleccione...</option>
                                        @foreach ($Coins as $coin)
                                            <option value="{{ $coin->id }}" @if (old('coin_id', $Product->coin_id) == $coin->id) selected @endif>
                                                {{ $coin->coin }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <x-jet-input-error for='coin_id' />
                                </div>
                                <div class="col-md-4 form-group">
                                    <x-jet-label value="* Proveedor" />
                                    <select name="provider_id" class="form-control w-full text-xs select2" required>
                                        <option value="">Seleccione...</option>
                                        @foreach ($Providers as $provider)
                                            <option value="{{ $provider->id }}" @if (old('provider_id', $Product->provider_id) == $provider->id) selected @endif>
                                                {{ $provider->customer }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <x-jet-input-error for='provider_id' />
                                </div>
                                <div class="col-md-12 form-group">
                                    <x-jet-label value="Observaciones del producto o servicio" />
                                    <textarea name="observations" class="form-control w-full text-xs" rows="3">{{ old('observations', $Product->observations ?? '') }}</textarea>
                                    <x-jet-input-error for='observations' />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-12 p-4 pt-0">
                    <div class="card shadow-sm rounded-lg">
                        <div class="card-header bg-white">
                            <h5 class="mb-0 font-weight-bold"><i class="fas fa-percent"></i> Impuestos</h5>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-4 form-group">
                                    <x-jet-label value="IVA" />
                                    <div class="flex items-center gap-2">
                                        <x-jet-input type="number" step="0.01" min="0" max="100" name="iva" class="w-full text-xs" value="{{ old('iva', $Product->iva ?? 0.16) }}" />
                                        <span class="text-sm font-semibold">%</span>
                                    </div>
                                    <x-jet-input-error for='iva' />
                                </div>
                                <div class="col-md-4 form-group">
                                    <x-jet-label value="IEPS" />
                                    <div class="flex items-center gap-2">
                                        <x-jet-input type="number" step="0.01" min="0" max="100" name="ieps" class="w-full text-xs" value="{{ old('ieps', $Product->ieps ?? 0) }}" />
                                        <span class="text-sm font-semibold">%</span>
                                    </div>
                                    <x-jet-input-error for='ieps' />
                                </div>
                                <div class="col-md-4 form-group">
                                    <x-jet-label value="ISR" />
                                    <div class="flex items-center gap-2">
                                        <x-jet-input type="number" step="0.01" min="0" max="100" name="isr" class="w-full text-xs" value="{{ old('isr', $Product->isr ?? 0) }}" />
                                        <span class="text-sm font-semibold">%</span>
                                    </div>
                                    <x-jet-input-error for='isr' />
                                </div>
                                <div class="col-md-4 form-group">
                                    <x-jet-label value="Retención IVA" />
                                    <div class="flex items-center gap-2">
                                        <x-jet-input type="number" step="0.01" min="0" max="100" name="retention_iva" class="w-full text-xs" value="{{ old('retention_iva', $Product->retention_iva ?? 0) }}" />
                                        <span class="text-sm font-semibold">%</span>
                                    </div>
                                    <x-jet-input-error for='retention_iva' />
                                </div>
                                <div class="col-md-4 form-group">
                                    <x-jet-label value="Retención ISR" />
                                    <div class="flex items-center gap-2">
                                        <x-jet-input type="number" step="0.01" min="0" max="100" name="retention_isr" class="w-full text-xs" value="{{ old('retention_isr', $Product->retention_isr ?? 0) }}" />
                                        <span class="text-sm font-semibold">%</span>
                                    </div>
                                    <x-jet-input-error for='retention_isr' />
                                </div>
                                <div class="col-md-4 form-group">
                                    <x-jet-label value="Otras retenciones" />
                                    <div class="flex items-center gap-2">
                                        <x-jet-input type="number" step="0.01" min="0" max="100" name="other_retentions" class="w-full text-xs" value="{{ old('other_retentions', $Product->other_retentions ?? 0) }}" />
                                        <span class="text-sm font-semibold">%</span>
                                    </div>
                                    <x-jet-input-error for='other_retentions' />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-12 text-right p-2 gap-2">
                    <a href="{{ route('products.index') }}" class="btn btn-black mb-2">
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