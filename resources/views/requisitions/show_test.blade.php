@extends('adminlte::page')

@section('title', $title)

@section('content_header')
    <h1 class="font-bold m-0 text-dark">
        <i class="fas fa-clipboard-check text-primary"></i>&nbsp; {{$title}}
    </h1>
@stop

@section('content')
<div class="container-fluid pb-4">
    <div class="card shadow-lg border-0 rounded-lg">
        <div class="card-body p-4 bg-white rounded-lg">
            
            <div class="row align-items-center mb-4 pb-3 border-bottom">
                <div class="col-md-3 text-center text-md-left mb-3 mb-md-0">
                    <img src="{{ asset('img/logo/logo.svg') }}" alt="TYRSA" class="img-fluid" style="max-height: 70px;">
                    <div class="text-lg font-weight-bold text-danger mt-2">
                        {{ $CompanyProfiles->company }}
                    </div>
                </div>
                
                <div class="col-md-5 text-muted text-xs mb-3 mb-md-0 border-left border-right px-3">
                    <p class="mb-1"><strong>Calle Cuernavaca S/N</strong>, Col. Ejido del Quemado,</p>
                    <p class="mb-1">C.P. 54963, Tultepec, Estado de México.</p>
                    <p class="mb-1"><strong>R.F.C.</strong> TCO990507S91</p>
                    <p class="mb-1"><strong>Tels:</strong> (55) 26472033 / 26473330</p>
                    <p class="mb-0 text-lowercase text-primary">info@tyrsa.com.mx &bull; www.tyrsa.com.mx</p>
                </div>
                
                <div class="col-md-4">
                    <table class="table table-sm table-bordered text-xs m-0 shadow-sm">
                        <thead class="bg-light text-center">
                            <tr>
                                <th colspan="2" class="text-uppercase font-weight-bold">Requisición Número</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="text-center font-weight-bold bg-yellow-light text-md text-dark">
                                <td colspan="2">{{ $InternalOrders->invoice }}</td>
                            </tr>
                            <tr>
                                <th class="bg-light w-50">NOHA:</th>
                                <td class="text-center font-weight-bold">{{ $InternalOrders->noha }}</td>
                            </tr>
                            <tr class="bg-light text-center">
                                <th colspan="2" class="font-weight-bold">Fechas (dd-mm-aa)</th>
                            </tr>
                            <tr>
                                <th>Emisión:</th>
                                <td class="text-center">{{ date('d - m - Y', strtotime($InternalOrders->reg_date)) }}</td>
                            </tr>
                            <tr>
                                <th>Entrega:</th>
                                <td class="text-center">{{ date('d - m - Y', strtotime($InternalOrders->date_delivery)) }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <h5 class="text-center font-weight-bold text-uppercase tracking-wider text-secondary my-4">
                Requisición de Compra
            </h5>

            <div class="table-responsive mb-4">
                <table class="table table-sm table-bordered text-xs m-0 table-custom-layout">
                    <thead class="bg-dark text-white text-center">
                        <tr>
                            <th colspan="14" class="text-uppercase py-2">Datos del Proveedor</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th colspan="2" class="bg-light font-weight-bold">Núm. Proveedor:</th>
                            <td colspan="2" class="text-center">{{ $Customers->clave }}</td>
                            <th colspan="2" class="bg-light font-weight-bold">Nombre Corto:</th>
                            <td colspan="4" class="text-center font-weight-bold">{{ $Customers->alias }}</td>
                            <th colspan="2" class="bg-light font-weight-bold">C.P:</th>
                            <td colspan="2" class="text-center font-weight-bold">{{ $Customers->customer_zip_code }}</td>
                        </tr>
                        <tr>
                            <th colspan="2" class="bg-light font-weight-bold">Razón Social:</th>
                            <td colspan="12" class="font-weight-bold py-2 text-primary">{{ $Customers->customer }}</td>
                        </tr>
                        <tr>
                            <th colspan="2" class="bg-light font-weight-bold">Régimen de Capital:</th>
                            <td colspan="12">S.A. DE C.V.</td>
                        </tr>
                        <tr>
                            <th colspan="2" class="bg-light font-weight-bold">Régimen Fiscal:</th>
                            <td colspan="12">RÉGIMEN GENERAL DE PERSONAS MORALES</td>
                        </tr>
                        <tr>
                            <th colspan="2" class="bg-light font-weight-bold">RFC:</th>
                            <td colspan="2" class="text-center font-weight-bold">{{ $Customers->customer_rfc }}</td>
                            <th colspan="2" class="bg-light font-weight-bold">Cot No:</th>
                            <td colspan="3" class="text-center">
                                {{ $InternalOrders->ncotizacion != 0 ? $InternalOrders->ncotizacion : '-' }}
                            </td>
                            <th colspan="2" class="bg-light font-weight-bold">Contrato No:</th>
                            <td colspan="3" class="text-center">
                                {{ $InternalOrders->ncontrato != 0 ? $InternalOrders->ncontrato : '-' }}
                            </td>
                        </tr>
                        <tr>
                            <th colspan="2" class="bg-light font-weight-bold">Domicilio Fiscal:</th>
                            <td colspan="7" class="align-middle">
                                {{ $Customers->customer_street.' '.$Customers->customer_outdoor.' '.$Customers->customer_intdoor.' '.$Customers->customer_suburb }}
                                <br>
                                <span class="text-muted">{{ $Customers->customer_city.' '.$Customers->customer_state.' '.$Customers->customer_zip_code }}</span>
                            </td>
                            <th class="bg-light font-weight-bold align-middle">Teléfono:</th>
                            <td colspan="4" class="text-center align-middle">{{ $Customers->customer_telephone }}</td>
                        </tr>
                        <tr>
                            <th rowspan="2" class="bg-light font-weight-bold text-center align-middle">Embarque</th>
                            <td rowspan="2" class="text-center align-middle font-weight-bold text-success">Sí</td>
                            <th colspan="2" class="bg-light font-weight-bold">Dirección de Embarque:</th>
                            <td colspan="10">
                                {{ $CustomerShippingAddresses->customer_shipping_city.' '.$CustomerShippingAddresses->customer_shipping_suburb }}
                                <br>
                                {{ $CustomerShippingAddresses->customer_shipping_street.' '.$CustomerShippingAddresses->customer_shipping_indoor }}
                            </td>
                        </tr>
                        <tr>
                            <th colspan="2" class="bg-light font-weight-bold">C.P. Embarque:</th>
                            <td colspan="10" class="font-weight-bold">{{ $CustomerShippingAddresses->customer_shipping_zip_code }}</td>
                        </tr>
                        <tr class="bg-light text-center font-weight-bold">
                            <td colspan="2" class="p-2">Requisitor</td>
                            <td colspan="2" class="bg-white p-2 text-dark">{{ $InternalOrders->requisitor }}</td>
                            <td colspan="2" class="p-2">PI</td>
                            <td colspan="2" class="bg-white p-2 text-dark">{{ $InternalOrders->pi }}</td>
                            <td colspan="2" class="p-2">Moneda</td>
                            <td colspan="2" class="bg-white p-2 text-dark">{{ $Coins->code }}</td>
                            <td colspan="1" class="p-2">Comprador</td>
                            <td colspan="1" class="bg-white p-2 text-dark">{{ $InternalOrders->comprador }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div class="table-responsive mb-4">
                <table class="table table-sm table-striped table-bordered text-xs m-0">
                    <thead class="bg-secondary text-white">
                        <tr>
                            <th class="text-center" style="width: 5%">Contacto</th>
                            <th>Nombre</th>
                            <th class="text-center">Tel. Móvil</th>
                            <th class="text-center">Tel. Fijo</th>
                            <th class="text-center" style="width: 8%">Ext.</th>
                            <th>Email</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $contact_index = 1; @endphp
                        @foreach($Contacts as $row)
                        <tr>
                            <td class="text-center font-weight-bold">{{ $contact_index }}</td>
                            <td>{{ $row->customer_contact_name }}</td>
                            <td class="text-center">{{ $row->customer_contact_mobile }}</td>
                            <td class="text-center">{{ $row->customer_contact_office_phone }}</td>
                            <td class="text-center">{{ $row->customer_contact_office_phone_ext }}</td>
                            <td class="text-lowercase text-primary">{{ $row->customer_contact_email }}</td>
                        </tr>
                        @php $contact_index++; @endphp
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="table-responsive mb-4">
                <table class="table table-sm table-bordered text-xs m-0 text-center custom-items-table">
                    <thead class="bg-dark text-white">
                        <tr>
                            <th style="width: 5%">Pda</th>
                            <th style="width: 8%">Cant</th>
                            <th style="width: 10%">Unidad</th>
                            <th style="width: 12%">Familia</th>
                            <th style="width: 12%">SKU</th>
                            <th>Precio Unit (Sin IVA)</th>
                            <th>Importe</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($Items as $row)
                        <tr class="bg-light">
                            <td class="font-weight-bold">{{ $row->item }}</td>
                            <td class="font-weight-bold text-info">{{ $row->amount }}</td>
                            <td>{{ $row->unit }}</td>
                            <td>{{ $row->family }}</td>
                            <td><code>{{ $row->sku }}</code></td>
                            <td rowspan="2" class="align-middle font-weight-bold text-md text-dark">
                                ${{ number_format($row->unit_price, 2) }}
                            </td>
                            <td rowspan="2" class="align-middle font-weight-bold text-md text-dark bg-gray-100">
                                ${{ number_format($row->import, 2) }}
                            </td>
                        </tr>
                        <tr>
                            <td colspan="5" class="text-left p-2 bg-white text-muted italic-description">
                                {!! nl2br(e($row->description)) !!}
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="row mb-4">
                <div class="col-md-6 mb-3 mb-md-0">
                    <table class="table table-sm table-bordered text-xs h-100 m-0">
                        <thead class="bg-secondary text-white">
                            <tr>
                                <th colspan="2" class="text-center text-uppercase">Estructura y Condiciones de Pago</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th class="bg-light w-40">Número de Pagos:</th>
                                <td class="font-weight-bold text-center text-md">{{ $payments->count() }}</td>
                            </tr>
                            <tr>
                                <th class="bg-light align-top py-2">Condiciones de Pago:</th>
                                <td class="py-2">
                                    @foreach($payments as $pay)
                                        <div class="mb-1 pb-1 border-bottom last-border-0">
                                            <span class="badge badge-primary d-inline px-2 py-1 mr-2">{{ $pay->percentage }}%</span> 
                                            <span class="text-dark font-weight-bold">{{ $pay->concept }}</span>
                                        </div>
                                    @endforeach
                                </td>
                            </tr>
                            <tr>
                                <th class="bg-light">Promesas de Pagos:</th>
                                <td class="text-muted italic">Planeación financiera declarada abajo</td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <div class="col-md-6">
                    <table class="table table-sm table-bordered text-xs m-0 shadow-sm float-right" style="max-width: 400px; width: 100%;">
                        <tbody>
                            <tr>
                                <th class="bg-light w-50 font-weight-bold py-2 px-3">Subtotal:</th>
                                <td class="text-right pr-3 font-weight-bold text-dark">${{ number_format($InternalOrders->subtotal, 2) }}</td>
                            </tr>
                            <tr>
                                <th class="bg-light font-weight-bold py-2 px-3">Descuento:</th>
                                <td class="text-right pr-3 text-danger">(${{ number_format($InternalOrders->descuento * $InternalOrders->subtotal, 2) }})</td>
                            </tr>
                            <tr>
                                <th class="bg-light class-ieps py-2 px-3">I.E.P.S:</th>
                                <td class="text-right pr-3">${{ number_format($InternalOrders->ieps * $InternalOrders->subtotal, 2) }}</td>
                            </tr>
                            <tr>
                                <th class="bg-light py-2 px-3">RET ISR:</th>
                                <td class="text-right pr-3 text-muted">${{ number_format($InternalOrders->isr * $InternalOrders->subtotal, 2) }}</td>
                            </tr>
                            <tr>
                                <th class="bg-light py-2 px-3">RET IVA (FLETE):</th>
                                <td class="text-right pr-3 text-muted">${{ number_format($InternalOrders->tasa * $Items->where('family','FLETE')->sum('import'), 2) }}</td>
                            </tr>
                            <tr>
                                <th class="bg-light font-weight-bold py-2 px-3">IVA (16%):</th>
                                <td class="text-right pr-3">${{ number_format(0.16 * $InternalOrders->subtotal * (1 - $InternalOrders->descuento), 2) }}</td>
                            </tr>
                            <tr class="bg-dark text-white text-md">
                                <th class="py-2 px-3 font-weight-bold text-uppercase">Total General:</th>
                                <td class="text-right pr-3 font-weight-bold">${{ number_format($InternalOrders->total, 2) }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="table-responsive mb-4">
                <table class="table table-sm table-bordered text-xs text-center m-0">
                    <thead class="bg-secondary text-white">
                        <tr>
                            <th colspan="8" class="py-2 text-uppercase font-weight-bold">Tabla de Promesas de Pagos / Planeación de Flujo</th>
                        </tr>
                        <tr>
                            <th rowspan="2" class="align-middle">Pago No.</th>
                            <th rowspan="2" class="align-middle">Fecha Promesa</th>
                            <th rowspan="2" class="align-middle">Día</th>
                            <th rowspan="2" class="align-middle">Semana</th>
                            <th colspan="3" class="border-bottom">Importe por Cobrar</th>
                            <th rowspan="2" class="align-middle">% del Total</th>
                        </tr>
                        <tr>
                            <th>Subtotal</th>
                            <th>IVA</th>
                            <th>Total con IVA</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $p = 0; @endphp
                        @foreach($payments as $pay)
                            @php
                                $datetime1 = new DateTime($pay->date);
                                $pdia = $datetime1->format('Y');
                                $datetime2 = new DateTime($pdia."-1-1");
                                $dias = $datetime2->diff($datetime1)->format('%a') + 1;
                                $p++;
                            @endphp
                            <tr>
                                <td class="font-weight-bold bg-light">{{ $p }}</td>
                                <td class="font-weight-bold text-primary">{{ date('d - m - Y', strtotime($pay->date)) }}</td>
                                <td>{{ $dias }}</td>
                                <td>{{ (int)floor($dias / 7) + 1 }}</td>
                                <td>${{ number_format($InternalOrders->subtotal * $pay->percentage * 0.01, 2) }}</td>
                                <td>${{ number_format($InternalOrders->subtotal * $pay->percentage * 0.0016, 2) }}</td>
                                <td class="font-weight-bold text-dark">${{ number_format($pay->amount, 2) }}</td>
                                <td>
                                    <span class="badge badge-outline-primary py-1 px-2 font-weight-bold">{{ $pay->percentage }}%</span>
                                </td>
                            </tr>
                        @endforeach
                        <tr class="bg-gray-100 font-weight-bold text-dark">
                            <th colspan="4" class="text-right pr-3 text-uppercase">Totales:</th>
                            <td>${{ number_format($InternalOrders->subtotal, 2) }}</td>
                            <td>${{ number_format($InternalOrders->subtotal * 0.16, 2) }}</td>
                            <td class="text-primary">${{ number_format($payments->sum('amount'), 2) }}</td>
                            <td class="text-success">100%</td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div class="card card-outline card-secondary mb-4 shadow-sm">
                <div class="card-header py-2 bg-light">
                    <h6 class="m-0 font-weight-bold text-secondary text-xs text-uppercase"><i class="fas fa-comments"></i> Observaciones Internas</h6>
                </div>
                <div class="card-body p-3 text-xs text-muted com-text">
                    {{ $InternalOrders->observations ? $InternalOrders->observations : 'Sin observaciones registradas.' }}
                </div>
            </div>

            <div class="row mb-5">
                <div class="col-md-5">
                    <table class="table table-sm table-bordered text-xs m-0 shadow-sm" id="correos">
                        <thead class="bg-light text-center">
                            <tr>
                                <th colspan="2" class="py-2 text-uppercase font-weight-bold text-secondary">Correos de Contacto</th>
                            </tr>
                            <tr class="bg-white text-muted">
                                <th style="width: 25%">ID</th>
                                <th>Email Asociado</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($Contacts as $row)
                            <tr>
                                <td class="text-center font-weight-bold bg-light">{{ $row->id }}</td>
                                <td class="text-lowercase font-weight-bold text-indigo px-3">{{ $row->customer_contact_email }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="border-top pt-4 mt-4">
                <div class="row text-center justify-content-center align-items-end">
                    <div class="col-md-3 mb-4 mb-md-0">
                        <div class="signature-block p-3 border rounded bg-light shadow-sm h-100 d-flex flex-column justify-content-between">
                            <div class="font-weight-bold text-sm text-dark pb-2 border-bottom">
                                {{ $Sellers->seller_name }}
                            </div>
                            <div class="py-4 font-italic text-muted text-xs">
                                {{ $Sellers->firma ? $Sellers->firma : '[ Firma Digital Activa ]' }}
                            </div>
                            <div>
                                <hr class="my-2 border-dark">
                                <span class="text-xs text-uppercase font-weight-bold tracking-wider text-secondary">Elaboró</span>
                            </div>
                        </div>
                    </div>

                    @foreach ($requiredSignatures as $firma)
                    <div class="col-md-4 mb-4 mb-md-0">
                        <div class="signature-block p-3 border rounded bg-white shadow-sm h-100 d-flex flex-column justify-content-between">
                            @if($firma->status == 0)
                                <form action="{{ route('requisition.firmar') }}" method="POST" enctype="multipart/form-data" class="m-0">
                                    @csrf
                                    <input type="hidden" name="signature_id" value="{{ $firma->id }}"/>
                                    <div class="text-xs text-uppercase font-weight-bold text-danger mb-2">
                                        Firma Pendiente: <span class="text-dark">{{ $firma->job }}</span>
                                    </div>
                                    <div class="input-group input-group-sm">
                                        <input type="password" name="key" placeholder="Contraseña de firma" class="form-control text-xs" required/>
                                        <div class="input-group-append">
                                            <button type="submit" class="btn btn-success btn-xs font-weight-bold px-3">Firmar</button>
                                        </div>
                                    </div>
                                </form>
                            @else
                                <div class="font-weight-bold text-success text-md mb-2">
                                    {{ $firma->firma }}
                                </div>
                                <div class="py-3">
                                    <span class="badge badge-success py-2 px-3 text-sm d-block shadow-sm">
                                        <i class="fa fa-check-circle mr-1"></i> Autorizado por {{ $firma->job }}
                                    </span>
                                </div>
                            @endif
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>

            <div class="mt-5 text-center p-3 rounded-lg border shadow-inner">
                @if($InternalOrders->status == 'autorizado')
                    <h4 class="m-0 font-weight-bold text-success tracking-wider text-uppercase">
                        <i class="fas fa-check-double mr-2"></i> Pedido 100% Autorizado
                    </h4>
                @else 
                    <h4 class="m-0 font-weight-bold text-danger tracking-wider text-uppercase">
                        <i class="fas fa-exclamation-triangle mr-2"></i> Faltan Autorizaciones en el Flujo
                    </h4>
                @endif
            </div>

            <div class="mt-4 pt-3 border-top d-flex justify-content-end gap-2 no-print">
                <button type="button" class="btn btn-danger btn-sm px-4 mr-2 shadow-sm font-weight-bold" onclick="window.print();">
                    <i class="fas fa-file-pdf mr-2"></i> Exportar a PDF / Imprimir
                </button>
                <a href="{{ route('requisition.edit_order', $InternalOrders->id) }}" class="btn btn-primary btn-sm px-4 shadow-sm font-weight-bold">
                    <i class="fas fa-edit mr-2"></i> Editar Requisición
                </a>
            </div>

        </div>
    </div>
</div>
@stop

@section('css')
<style>
/* Estilo de impresión unificado */
@media print {
    .no-print, .main-footer, .brand-link, .nav-sidebar, .content-header, .btn, .btn-sm {
        display: none !important;
    }
    .content-wrapper {
        margin-left: 0 !important;
        padding: 0 !important;
        background-color: #fff !important;
    }
    .card {
        box-shadow: none !important;
        border: none !important;
    }
    .card-body {
        padding: 0 !important;
    }
    body {
        font-size: 10px !important;
        background-color: #ffffff !important;
    }
    .table {
        width: 100% !important;
        border-collapse: collapse !important;
    }
    .table td, .table th {
        border: 1px solid #000000 !important;
        padding: 4px !important;
    }
}

/* Clases de utilidad UI */
.bg-yellow-light {
    background-color: #fffde7;
}
.italic-description {
    font-style: italic;
    line-height: 1.4;
}
.com-text {
    white-space: pre-wrap;
    word-wrap: break-word;
    background-color: #fafafa;
    border-radius: 4px;
}
.gap-2 > * {
    margin-left: 8px;
}
.w-40 { width: 40%; }
.last-border-0:last-child {
    border-bottom: 0 !important;
}
.badge-outline-primary {
    color: #2b416d;
    border: 1px solid #2b416d;
    background-color: transparent;
}
.signature-block {
    min-height: 150px;
    border-top: 3px solid #6c757d !important;
}
</style>
@stop

@section('js')
<script>
    $(document).ready(function() {
        console.log("Plantilla de Requisición renderizada correctamente.");
    });
</script>
@stop