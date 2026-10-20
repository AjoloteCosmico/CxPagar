@extends('adminlte::page')

@section('title', 'PARTIDAS')

@section('content_header')
    <h1 class="font-bold"><i class="fa-brands fa-buffer"></i>&nbsp; Partida</h1>
@stop

@section('content')
    <div class="container bg-gray-300 shadow-lg rounded-lg">
        <div class="row rounded-b-none rounded-t-lg shadow-xl bg-white">
            <h5 class="card-title p-2">
                <i class="fas fa-plus-circle"></i>&nbsp; Editar Partida:
            </h5>
        </div>
        <form action="{{ route('temp_items.redefine',[$Id,$Captured])}}" method="POST" enctype="multipart/form-data">
        @csrf
        <x-jet-input type="hidden" name="temp_internal_order_id" value="{{ $TempInternalOrders }}"/>
        <x-jet-input type="hidden" name="item" value="{{ $Item ->item}}"/>
        <div class="row rounded-b-lg rounded-t-none mb-4 shadow-xl bg-gray-300">
            <div class="row p-4">
                <div class="col-sm-12 col-xs-12 shadow rounded-xl p4">
                    <div class="card">
                        <div class="card-body">
                            <div class="form-group">
                                <x-jet-label value="* Cantidad" />
                                <x-jet-input type="number" name="amount" class="w-full text-xs" value="{{$Item->amount}}"/>
                                <x-jet-input-error for='amount' />
                            </div>
                            <div class="form-group">
                                <x-jet-label value="* Unidad" />
                                <select class="form-capture w-full text-xs uppercase" name="unit">
                                    @foreach ($Units as $row)
                                        <option value="{{$row->unit}}" @if ($row->id == $Item->unit) selected @endif >{{$row->unit}}</option>
                                    @endforeach
                                </select>
                                <x-jet-input-error for='unit' />
                            </div>
                            <div class="form-group">
                                <x-jet-label value="* Tipo de bien" />
                                <select class="form-capture w-full text-xs uppercase" name="type" id="product-type">
                                    <option value="">Seleccione...</option>
                                    @foreach (($productTypes ?? []) as $typeOption)
                                        <option value="{{ $typeOption }}" {{ old('type', $Item->type ?? '') == $typeOption ? 'selected' : '' }}>{{ $typeOption }}</option>
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
                                <x-jet-input type="text" name="otro" id="otro" hidden='hidden' class="w-full text-xs" value="{{ $Item->producto ?? '' }}" placeholder="Especifique" />
                            </div>
                            <div class="form-group">
                                <x-jet-label value="* Descripcion" />
                                <x-jet-input type="text" name="description" class="w-full text-xs" value="{{$Item->description}}" onkeyup="javascript:this.value=this.value.toUpperCase();"/>
                                <x-jet-input-error for='description' />
                            </div>
                            <div class="form-group">
                                <x-jet-label value="* SKU" />
                                <select name="sku" class="form-capture w-full text-xs uppercase" value="{{$Item->sku}}" onkeyup="javascript:this.value=this.value.toUpperCase();">
                                    <option value="SV">SV</option>
                                </select>
                                <x-jet-input-error for='sku' />
                            </div>
                            <div class="form-group">
                                <x-jet-label value="* Precio Unitario" />
                                <x-jet-input type="number" step="0.01" name="unit_price" id="input-price" class="form-control just-number price-format-input" class="w-full text-xs" value="{{$Item->unit_price}}"/>
                                <x-jet-input-error for='unit_price' />
                            </div>
                            <div class="form-group">
                                <x-jet-label value="IVA" />
                                <x-jet-input type="number" step="0.01" min="0" max="100" name="iva" id="iva" class="form-control just-number price-format-input" class="w-full text-xs" value="{{ old('iva', $Item->iva ?? 0) }}" readonly/>
                                <x-jet-input-error for='iva' />
                            </div>
                            <div class="form-group">
                                <x-jet-label value="IEPS" />
                                <x-jet-input type="number" step="0.01" min="0" max="100" name="ieps" id="ieps" class="form-control just-number price-format-input" class="w-full text-xs" value="{{ old('ieps', $Item->ieps ?? 0) }}" readonly/>
                                <x-jet-input-error for='ieps' />
                            </div>
                            <div class="form-group">
                                <x-jet-label value="ISR" />
                                <x-jet-input type="number" step="0.01" min="0" max="100" name="isr" id="isr" class="form-control just-number price-format-input" class="w-full text-xs" value="{{ old('isr', $Item->isr ?? 0) }}" readonly/>
                                <x-jet-input-error for='isr' />
                            </div>
                            <div class="form-group">
                                <x-jet-label value="RETENCION IVA" />
                                <x-jet-input type="number" step="0.01" min="0" max="100" name="retencion_iva" id="retencion_iva" class="form-control just-number price-format-input" class="w-full text-xs" value="{{ old('retencion_iva', $Item->retencion_iva ?? 0) }}" readonly/>
                                <x-jet-input-error for='retencion_iva' />
                            </div>
                            <div class="form-group">
                                <x-jet-label value="RETENCION ISR" />
                                <x-jet-input type="number" step="0.01" min="0" max="100" name="retencion_isr" id="retencion_isr" class="form-control just-number price-format-input" class="w-full text-xs" value="{{ old('retencion_isr', $Item->retencion_isr ?? 0) }}" readonly/>
                                <x-jet-input-error for='retencion_isr' />
                            </div>
                            <div class="form-group">
                                <x-jet-label value="OTRAS RETENCIONES" />
                                <x-jet-input type="number" step="0.01" min="0" max="100" name="other_retentions" id="other_retentions" class="form-control just-number price-format-input" class="w-full text-xs" value="{{ old('other_retentions', $Item->other_retentions ?? 0) }}" readonly/>
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

@section('js')
<script>
const productsByType = @json($productsByType ?? []);

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
    if (!productData) {
        $('#iva').val(0);
        $('#ieps').val(0);
        $('#isr').val(0);
        $('#retencion_iva').val(0);
        $('#retencion_isr').val(0);
        $('#other_retentions').val(0);
        $('#input-price').val(0);
        return;
    }

    $('#iva').val(productData.iva ?? 0);
    $('#ieps').val(productData.ieps ?? 0);
    $('#isr').val(productData.isr ?? 0);
    $('#retencion_iva').val(productData.retencion_iva ?? 0);
    $('#retencion_isr').val(productData.retencion_isr ?? 0);
    $('#other_retentions').val(productData.other_retentions ?? 0);
    $('#input-price').val(productData.public_price ?? 0);
}

$(document).ready(function(){
    const tipoBienSelect = $('#product-type');
    const productSelect = $('#product-select');
    const initialType = tipoBienSelect.val();

    if (initialType) {
        populateProductSelect(initialType);
        const selectedProductId = '{{ $Item->product ?? $Item->producto ?? '' }}';
        if (selectedProductId) {
            $('#product-select').val(selectedProductId);
            const list = productsByType[initialType] || [];
            const productData = list.find(item => String(item.id) === String(selectedProductId));
            fillProductTaxFields(productData || null);
        }
    }

    tipoBienSelect.on('change', function () {
        populateProductSelect($(this).val());
        fillProductTaxFields(null);
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
});
</script>
@stop