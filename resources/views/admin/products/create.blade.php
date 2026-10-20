@extends('adminlte::page')

@section('title', 'PRODUCTO')

@section('content_header')
    <h1 class="font-bold"><i class="fas fa-tag"></i>&nbsp; Producto / Servicio</h1>
@stop

@section('content')
    <div class="container bg-gray-300 shadow-lg rounded-lg">
        @if ($errors->any())
            <div class="alert alert-danger mb-0 rounded-top">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <div class="row rounded-b-none rounded-t-lg shadow-xl bg-white">
            <h5 class="card-title p-2">
                <i class="fas fa-plus-circle"></i>&nbsp; Agregar Producto:
            </h5>
        </div>
        <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
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
                                    <x-jet-label value="* SKU" />
                                    <x-jet-input type="text" name="sku" class="w-full text-xs" value="{{ old('sku') }}" required />
                                    <x-jet-input-error for='sku' />
                                </div>
                                 
                                <div class="col-md-6 form-group">
                                    <x-jet-label value="* TIPO DE BIEN" />
                                    <select name="type" id="product-type" class="form-control w-full text-xs uppercase" required>
                                        <option value="">Seleccione...</option>
                                        @foreach (($dynamicGastosFijos['types'] ?? []) as $typeOption)
                                            <option value="{{ $typeOption }}" {{ old('type') == $typeOption ? 'selected' : '' }}>
                                                {{ $typeOption }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <x-jet-input-error for='type' />
                                </div>

                                <div class="col-md-6 form-group">
                                    <x-jet-label value="* CLAVE ALTERNA" />
                                    <x-jet-input type="text" name="clave_alterna"  required class="w-full text-xs" value="{{ old('clave_alterna') }}" id="clave_alterna" />
                                    <x-jet-input-error for='clave_alterna' />
                                </div>
                                
                                <div class="col-md-6 form-group">
                                    <x-jet-label value="* PRODUCTO / SERVICIO" />
                                    <select id="product-select" name="product" class="form-control w-full text-xs uppercase" required>
                                        <option value="">Seleccione...</option>
                                    </select>
                                    <x-jet-input-error for='product' />
                                </div>
                                <div class="col-md-12 form-group">
                                    <x-jet-label value="* Descripción" />
                                    <textarea name="description" class="form-control w-full text-xs" rows="3">{{ old('description') }}</textarea>
                                    <x-jet-input-error for='description' />
                                </div>
                                <div class="col-md-6 form-group">
                                    <x-jet-label value="* Familia" />
                                    <x-jet-input type="text" name="family" class="w-full text-xs" value="{{ old('family') }}" />
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
                                        <x-jet-input type="number" step="0.01" min="0.01" name="public_price" class="w-full text-xs" value="{{ old('public_price') }}" />
                                        <span class="text-sm font-semibold">$</span>
                                    </div>
                                    <x-jet-input-error for='public_price' />
                                </div>
                                <div class="col-md-4 form-group">
                                    <x-jet-label value="* Moneda" />
                                    <select name="coin_id" class="form-control w-full text-xs" required>
                                        <option value="">Seleccione...</option>
                                        @foreach ($Coins as $coin)
                                            <option value="{{ $coin->id }}" @if (old('coin_id') == $coin->id) selected @endif>
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
                                            <option value="{{ $provider->id }}" @if (old('provider_id') == $provider->id) selected @endif>
                                                {{ $provider->customer }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <x-jet-input-error for='provider_id' />
                                </div>
                                <div class="col-md-12 form-group">
                                    <x-jet-label value="Observaciones del producto o servicio" />
                                    <textarea name="observations" class="form-control w-full text-xs" rows="3">{{ old('observations') }}</textarea>
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
                                        <x-jet-input type="number" step="0.01" min="0" max="100" name="iva" class="w-full text-xs" value="{{ old('iva', 16) }}" />
                                        <span class="text-sm font-semibold">%</span>
                                    </div>
                                    <x-jet-input-error for='iva' />
                                </div>
                                <div class="col-md-4 form-group">
                                    <x-jet-label value="IEPS" />
                                    <div class="flex items-center gap-2">
                                        <x-jet-input type="number" step="0.01" min="0" max="100" name="ieps" class="w-full text-xs" value="{{ old('ieps', 0) }}" />
                                        <span class="text-sm font-semibold">%</span>
                                    </div>
                                    <x-jet-input-error for='ieps' />
                                </div>
                                <div class="col-md-4 form-group">
                                    <x-jet-label value="ISR" />
                                    <div class="flex items-center gap-2">
                                        <x-jet-input type="number" step="0.01" min="0" max="100" name="isr" class="w-full text-xs" value="{{ old('isr', 0) }}" />
                                        <span class="text-sm font-semibold">%</span>
                                    </div>
                                    <x-jet-input-error for='isr' />
                                </div>
                                <div class="col-md-4 form-group">
                                    <x-jet-label value="Retención IVA" />
                                    <div class="flex items-center gap-2">
                                        <x-jet-input type="number" step="0.01" min="0" max="100" name="retention_iva" class="w-full text-xs" value="{{ old('retention_iva', 0) }}" />
                                        <span class="text-sm font-semibold">%</span>
                                    </div>
                                    <x-jet-input-error for='retention_iva' />
                                </div>
                                <div class="col-md-4 form-group">
                                    <x-jet-label value="Retención ISR" />
                                    <div class="flex items-center gap-2">
                                        <x-jet-input type="number" step="0.01" min="0" max="100" name="retention_isr" class="w-full text-xs" value="{{ old('retention_isr', 0) }}" />
                                        <span class="text-sm font-semibold">%</span>
                                    </div>
                                    <x-jet-input-error for='retention_isr' />
                                </div>
                                <div class="col-md-4 form-group">
                                    <x-jet-label value="Otras retenciones" />
                                    <div class="flex items-center gap-2">
                                        <x-jet-input type="number" step="0.01" min="0" max="100" name="other_retentions" class="w-full text-xs" value="{{ old('other_retentions', 0) }}" />
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
        const productOptionsByType = @json($dynamicGastosFijos['productOptionsByType'] ?? []);

        function populateProductSelect(selectedType) {
            const productSelect = $('#product-select');
            const options = productOptionsByType[selectedType] || [];

            productSelect.empty();
            productSelect.append('<option value="">Seleccione...</option>');

            options.forEach(function (optionValue) {
                const isSelected = ('{{ old('product') }}' || '').toUpperCase() === optionValue.toUpperCase();
                productSelect.append(
                    $('<option>', {
                        value: optionValue,
                        text: optionValue,
                        selected: isSelected
                    })
                );
            });
        }

        $(document).ready(function () {
            $('.select2').select2({
                placeholder: 'Seleccione...',
                allowClear: true,
                width: '100%'
            });

            const tipoBienSelect = $('select[name="type"]');
            const initialType = tipoBienSelect.val();
            if (initialType) {
                populateProductSelect(initialType);
            }

            tipoBienSelect.on('change', function () {
                populateProductSelect($(this).val());
            });
        });
    </script>

    <script>
document.addEventListener('DOMContentLoaded', function () {
    const input = document.getElementById('clave_alterna');
    if (!input) return;

    // Normalización "suave" (mientras escribe)
    function normalizeBase(str) {
        return str
            .toLowerCase()
            .normalize('NFD')                    // descompone á -> a + ´
            .replace(/[\u0300-\u036f]/g, '')     // elimina diacríticos (ñ -> n)
            .replace(/[^a-z0-9\s_-]/g, '')       // sólo alfanuméricos, espacios, _ y -
            .replace(/[\s_]+/g, '-')             // espacios y _ -> -
            .replace(/-+/g, '-');                // colapsa guiones repetidos
    }

    // Normalización "final" (al salir del campo)
    function normalizeFinal(str) {
        return normalizeBase(str).replace(/^-+|-+$/g, '');
    }

    function applySanitize(final = false) {
        const original = input.value;
        const cursor   = input.selectionStart ?? original.length;

        const cleaned  = final ? normalizeFinal(original) : normalizeBase(original);
        if (cleaned === original) return;

        input.value = cleaned;

        // Reposiciona el cursor normalizando el prefijo (para que no salte al final)
        const safePos = (final ? normalizeFinal(original.slice(0, cursor))
                                : normalizeBase(original.slice(0, cursor))).length;
        input.setSelectionRange(safePos, safePos);
    }

    input.addEventListener('input', () => applySanitize(false));
    input.addEventListener('blur',  () => applySanitize(true));
});
</script>
@stop