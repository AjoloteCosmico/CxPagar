@extends('adminlte::page')

@section('title', 'PARTIDAS')

@section('content_header')
    <h1 class="font-bold"><i class="fa-brands fa-buffer"></i>&nbsp; Partida</h1>
@stop

@section('content')
    <div class="container bg-gray-300 shadow-lg rounded-lg">
        <div class="row rounded-b-none rounded-t-lg shadow-xl bg-white">
            <h5 class="card-title p-2">
                <i class="fas fa-plus-circle"></i>&nbsp; Agregar Partida:
            </h5>
        </div>
        <form action="{{ route('temp_items.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <x-jet-input type="hidden" name="temp_internal_order_id" value="{{ $TempInternalOrders }}"/>
        <x-jet-input type="hidden" name="item" value="{{ $Item }}"/>
        <div class="row rounded-b-lg rounded-t-none mb-4 shadow-xl bg-gray-300">
            <div class="row p-4">
                <div class="col-sm-12 col-xs-12 shadow rounded-xl p4">
                    <div class="card">
                        <div class="card-body">
                            <div class="form-group">
                                <x-jet-label value="* SKU" />
                                <select name="sku" id="sku-select" class="form-capture w-full text-xs uppercase select2" required>
                                    <option value="">Seleccione...</option>
                                    @foreach (($allProducts ?? []) as $product)
                                        <option value="{{ $product['sku'] }}" data-product='@json($product)'>
                                            {{ $product['sku'] }}{{ !empty($product['clave_alterna']) ? ' - ' . $product['clave_alterna'] : '' }}
                                        </option>
                                    @endforeach
                                </select>
                                <x-jet-input-error for='sku' />
                            </div>

                            <div class="form-group">
                                <x-jet-label value="* Cantidad" />
                                <x-jet-input type="number" name="amount" class="w-full text-xs" value="{{ old('amount') }}"/>
                                <x-jet-input-error for='amount' />
                            </div>
                            <div class="form-group">
                                <x-jet-label value="* Unidad" />
                                <select class="form-capture  w-full text-xs uppercase" name="unit">
                                    @foreach ($Units as $row)
                                        <option value="{{ $row->unit }}" @if ($row->id == old('unit')) selected @endif >{{ $row->unit }}</option>
                                    @endforeach
                                </select>
                                <x-jet-input-error for='unit' />
                            </div>

                            <div class="form-group">
                                <x-jet-label value="* Tipo de bien" />
                                <select class="form-capture w-full text-xs uppercase" name="type" id="product-type">
                                    <option value="">Seleccione...</option>
                                    @foreach (($productTypes ?? []) as $typeOption)
                                        <option value="{{ $typeOption }}">{{ $typeOption }}</option>
                                    @endforeach
                                </select>
                                <x-jet-input-error for='type' />
                            </div>

                            <div class="form-group">
                                <x-jet-label value="* Producto / servicio" />
                                <select class="form-capture w-full text-xs uppercase" name="product" id="product-select">
                                    <option value="">Seleccione...</option>
                                </select>
                                <x-jet-input-error for='product' />
                                <x-jet-input type="text" name="otro" id="otro" hidden='hidden' class="w-full text-xs" placeholder="Especifique" />
                            </div>

                            <div class="form-group">
                                <x-jet-label value="* Descripcion" />
                                <x-jet-input type="text" name="description" class="w-full text-xs" value="{{ old('description') }}" onkeyup="javascript:this.value=this.value.toUpperCase();"/>
                                <x-jet-input-error for='description' />
                            </div>

                            <div class="form-group">
                                <x-jet-label value="* Precio Unitario" />
                                <x-jet-input type="number" step="0.01" name="unit_price" id="input-price" class="form-control just-number price-format-input" class="w-full text-xs" value="{{ old('unit_price') }}"/>
                                <x-jet-input-error for='unit_price' />
                            </div>

                            <div class="form-group">
                                <x-jet-label value="IVA" />
                                <x-jet-input type="number" step="0.01" min="0" max="100" name="iva" id="iva" class="form-control just-number price-format-input" class="w-full text-xs" value="{{ old('iva', 0) }}" readonly/>
                                <x-jet-input-error for='iva' />
                            </div>
                            <div class="form-group">
                                <x-jet-label value="IEPS" />
                                <x-jet-input type="number" step="0.01" min="0" max="100" name="ieps" id="ieps" class="form-control just-number price-format-input" class="w-full text-xs" value="{{ old('ieps', 0) }}" readonly/>
                                <x-jet-input-error for='ieps' />
                            </div>
                            <div class="form-group">
                                <x-jet-label value="ISR" />
                                <x-jet-input type="number" step="0.01" min="0" max="100" name="isr" id="isr" class="form-control just-number price-format-input" class="w-full text-xs" value="{{ old('isr', 0) }}" readonly/>
                                <x-jet-input-error for='isr' />
                            </div>
                            <div class="form-group">
                                <x-jet-label value="RETENCION IVA" />
                                <x-jet-input type="number" step="0.01" min="0" max="100" name="retencion_iva" id="retencion_iva" class="form-control just-number price-format-input" class="w-full text-xs" value="{{ old('retencion_iva', 0) }}" readonly/>
                                <x-jet-input-error for='retencion_iva' />
                            </div>
                            <div class="form-group">
                                <x-jet-label value="RETENCION ISR" />
                                <x-jet-input type="number" step="0.01" min="0" max="100" name="retencion_isr" id="retencion_isr" class="form-control just-number price-format-input" class="w-full text-xs" value="{{ old('retencion_isr', 0) }}" readonly/>
                                <x-jet-input-error for='retencion_isr' />
                            </div>
                            <div class="form-group">
                                <x-jet-label value="OTRAS RETENCIONES" />
                                <x-jet-input type="number" step="0.01" min="0" max="100" name="other_retentions" id="other_retentions" class="form-control just-number price-format-input" class="w-full text-xs" value="{{ old('other_retentions', 0) }}" readonly/>
                                <x-jet-input-error for='other_retentions' />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 text-right p-2 gap-2">
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

@push('js')
<script>
const productsByType = @json($productsByType ?? []);
const allProducts = @json($allProducts ?? []);

function populateProductSelect(selectedType) {
    const productSelect = $('#product-select');
    const options = productsByType[selectedType] || [];

    productSelect.empty();
    productSelect.append('<option value="">Seleccione...</option>');

    options.forEach(function (option) {
        productSelect.append($('<option>', {
            value: option.id,
            text: option.product + (option.family ? ' - ' + option.family : ''),
            selected: false
        }));
    });

    productSelect.append('<option value="OTRO">OTRO</option>');
}

function fillProductTaxFields(productData) {
    const data = productData || {};

    $('#iva').val(data.iva ?? 0);
    $('#ieps').val(data.ieps ?? 0);
    $('#isr').val(data.isr ?? 0);
    $('#retencion_iva').val(data.retention_iva ?? 0);
    $('#retencion_isr').val(data.retention_isr ?? 0);
    $('#other_retentions').val(data.other_retentions ?? 0);
    $('#input-price').val(data.public_price ?? 0);
}

function applySelectedProduct(productData) {
    if (!productData) {
        $('#product-type').val('').trigger('change');
        $('#product-select').val('').trigger('change');
        fillProductTaxFields(null);
        return;
    }

    const selectedType = productData.type || '';
    $('#product-type').val(selectedType).trigger('change');

    setTimeout(function () {
        const productSelect = $('#product-select');
        const selectedOption = productSelect.find('option[value="' + productData.id + '"]');

        if (selectedOption.length) {
            productSelect.val(productData.id).trigger('change');
        } else {
            productSelect.val('OTRO').trigger('change');
            $('#otro').removeAttr('hidden');
            $('#otro').val(productData.product || '');
        }

        const descriptionInput = $('input[name="description"]');
        if (descriptionInput.length && !descriptionInput.val().trim()) {
            descriptionInput.val(String(productData.product || '').toUpperCase());
        }
    }, 50);

    fillProductTaxFields(productData);
}

$(document).ready(function(){
    const tipoBienSelect = $('#product-type');
    const productSelect = $('#product-select');
    const skuSelect = $('#sku-select');

    skuSelect.select2({
        placeholder: 'Buscar SKU...',
        allowClear: true,
        width: '100%',
        matcher: function (params, data) {
            if ($.trim(params.term) === '') {
                return data;
            }

            const term = params.term.toUpperCase();
            const text = (data.text || '').toUpperCase();
            const clave = ($(data.element).data('clave-alterna') || '').toUpperCase();

            if (text.indexOf(term) > -1 || clave.indexOf(term) > -1) {
                return data;
            }

            return null;
        }
    });

    tipoBienSelect.on('change', function () {
        populateProductSelect($(this).val());
        if (!skuSelect.val()) {
            fillProductTaxFields(null);
        }
    });

    productSelect.on('change', function () {
        const selectedValue = $(this).val();

        if (selectedValue === 'OTRO') {
            $('#otro').removeAttr('hidden');
            fillProductTaxFields(null);
            return;
        }

        $('#otro').attr('hidden', 'hidden');
        const selectedType = tipoBienSelect.val();
        const list = productsByType[selectedType] || [];
        const productData = list.find(item => String(item.id) === String(selectedValue));
        fillProductTaxFields(productData || null);
    });

    skuSelect.on('change', function () {
        const selectedSku = $(this).val();

        if (!selectedSku) {
            $('#product-type').val('').trigger('change');
            $('#product-select').val('').trigger('change');
            fillProductTaxFields(null);
            return;
        }

        const productData = allProducts.find(item => String(item.sku) === String(selectedSku));
        applySelectedProduct(productData || null);
    });
});
</script>
@endpush