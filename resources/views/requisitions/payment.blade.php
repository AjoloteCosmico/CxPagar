@extends('adminlte::page')

@section('title', 'REQUISICION DE COMPRA')

@section('content_header')
    <h1 class="font-bold"><i class="fas fa-credit-card"></i>&nbsp; CONDICIONES DE PAGO</h1>
    
@stop

@section('content')
<div class="container-flex m-1 bg-gray-300 shadow-lg rounded-lg">

        <div class="row p-3 m-2 rounded-lg shadow-xl bg-white">
            <div class="row p-4">
                <div class="col-sm-12 text-center font-bold text-sm">
                <table>
                        <tr>
                            <td rowspan="4">
                               <img src="{{asset('img/logo/logo.svg')}}" alt="TYRSA">
                            </td>
                        </tr>
                        <tr>
                            <td class="text-lg" style="color: red">{{ $CompanyProfiles->company}}</td>
                        </tr>
                        <tr>
                            <td>{{ $CompanyProfiles->motto}}</td>
                        </tr>
                        <tr class="text-xs">
                            <td>
                                <br>
                                Domicilio Fiscal:<br>
                                {{$CompanyProfiles->street.' '.$CompanyProfiles->outdoor.' '.$CompanyProfiles->intdoor.' '.$CompanyProfiles->suburb.' '.$CompanyProfiles->city.' '.$CompanyProfiles->state.' '.$CompanyProfiles->zip_code}}<br>
                                R.F.C: {{$CompanyProfiles->rfc}} &nbsp; Tels: 01-52 {{$CompanyProfiles->telephone.', '.$CompanyProfiles->telephone2}} &nbsp; E-mail: {{$CompanyProfiles->email}} &nbsp; Web: {{$CompanyProfiles->website}}
                            </td>
                        </tr>
                    </table>
                    <br><br>
                    <table class="table">
  <thead>
    <tr>
      <th scope="col">RESUMEN DE LA REQUISICION (P.I.) NUMERO</th>
      <td >{{$InternalOrders->invoice}}</td>
      
    </tr>
  </thead>
  <tbody>
    <tr>
      <th scope="row">Moneda</th>
      <td>{{$Coins->code}}</td>
      
    </tr>
  </tbody>
  
</table>

                    <br><br>
<p style ="font-size:250%;">PROMESAS DE PAGO</p>
<br>
<h2 style='color:#2C426C; font-size: 150%'>* Todos los pagos incluyen IVA</h2>
<br><br>
<form action="{{ route('requisition.pay_conditions')}}" method="POST" enctype="multipart/form-data" id="form1">
@csrf
<x-jet-input type="hidden" name="rowcount"  id="rowcount" value={{$npagos}}/>
<x-jet-input type="hidden" name="customerID"   value="{{$InternalOrders->customer_id}}" />
<x-jet-input type="hidden" name="sellerID" value="{{$InternalOrders->seller_id}}"/>
<x-jet-input type="hidden" name="sellerID" value="{{$InternalOrders->customer_shipping_address_id}}"/>
<x-jet-input type="hidden" name="coinID" value="{{$InternalOrders->coin_id}}"/>
<x-jet-input type="hidden" name="total" id="total" value="{{$InternalOrders->total}}"/>
<x-jet-input type="hidden" name="order_id" value="{{$InternalOrders->id}}"/>
<x-jet-input type="hidden" name="" value=0/>

<div class="row">
    <div class="col-lg-8 mx-auto">
        <div class="card">
            <div class="card-body">
                <div class="mb-3">
                    <div class="progress">
                        <div id="wizard-progress" class="progress-bar bg-success" role="progressbar" style="width: 0%;" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">0%</div>
                    </div>
                    <p class="mt-2 text-end mb-0"><span id="wizard-step-label">Paso 1 de {{$npagos}}</span></p>
                </div>
                <div id="payments-wizard">
                    @php
                        $emision = new DateTime($InternalOrders->reg_date);
                        $entrega = new DateTime($InternalOrders->date_delivery);
                    @endphp
                    @for ($i = 1; $i <= $npagos; $i++)
                        @php
                            $aux_count=$aux_count+1;
                        @endphp
                        <div class="payment-step" data-step="{{$aux_count}}" @if($aux_count == 1) style="display: block;" @else style="display: none;" @endif>
                            <div class="row mb-3">
                                <div class="col-12">
                                    <h5 class="text-primary">PAGO {{$aux_count}}</h5>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label fw-bold">% negociado</label>
                                        <div class="input-group">
                                            <input type='number' min='0' max='100' step='1' name="{{'porcentaje['.$aux_count.']'}}" id="{{'P'.$aux_count}}" class="form-control text-center" value="0">
                                            <span class="input-group-text">%</span>
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label fw-bold">Cantidad</label>
                                        <div class="input-group">
                                            <span class="input-group-text">{{$Coins->symbol}}</span>
                                            <input type='number' min='0' step='any' max='{{ number_format($InternalOrders->total,2) }}' id="{{'R'.$aux_count}}" class="form-control" value="0.00">
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label fw-bold">Fecha</label>
                                        <input type='date' required class='form-control date' name="{{'date['.$aux_count.']'}}" id="{{'D'.$aux_count}}" value="@if($i==1){{$emision->format('Y-m-d')}}@else{{$entrega->format('Y-m-d')}}@endif">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label fw-bold">Concepto</label>
                                        <input type='text' name="{{'concepto['.$aux_count.']'}}" id="{{'C'.$aux_count}}" class="form-control text-uppercase"  onkeyup="javascript:this.value=this.value.toUpperCase();">
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label fw-bold">Forma de pago</label>
                                        <input type='text' name="{{'forma_pago['.$aux_count.']'}}" id="{{'FP'.$aux_count}}" class="form-control text-uppercase" onkeyup="javascript:this.value=this.value.toUpperCase();">
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label fw-bold">No. cuenta</label>
                                        <input type='text' name="{{'no_cuenta['.$aux_count.']'}}" id="{{'NC'.$aux_count}}" class="form-control text-uppercase"  onkeyup="javascript:this.value=this.value.toUpperCase();">
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label fw-bold">Horario de recibo</label>
                                        <input type='text' name="{{'horario_recibo['.$aux_count.']'}}" id="{{'H'.$aux_count}}" class="form-control text-uppercase" onkeyup="javascript:this.value=this.value.toUpperCase();">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label fw-bold">Condiciones de entrega</label>
                                        <input type='text' name="{{'condiciones_entrega['.$aux_count.']'}}" id="{{'CE'.$aux_count}}" class="form-control text-uppercase" onkeyup="javascript:this.value=this.value.toUpperCase();">
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endfor
                </div>
            </div>
            <div class="card-footer bg-white d-flex justify-content-between align-items-center">
                <button type="button" onclick="prevPayment()" id="btn-prev" class="btn btn-black mb-2"><i class="fas fa-arrow-left"></i> Anterior</button>
                <!-- <button type="button" class="btn btn-blue" onclick="redondear()"><i class="fa-regular fa-circle fa-2x"></i> Redondear</button> -->
                <button type="button" onclick="nextPayment()" id="btn-next" class="btn btn-green mb-2">Siguiente <i class="fas fa-arrow-right"></i></button>
            </div>
        </div>
    </div>
</div>
</form>

<div class="row mt-4">
    <div class="col-lg-8 mx-auto">
        <div class="card">
            <div class="card-header bg-light"><h5 class="mb-0">Resumen de Pagos</h5></div>
            <div class="card-body"><div id="summary-list" class="list-group"></div></div>
        </div>
    </div>
</div>

<div class="row mt-4">
    <div class="col-lg-8 mx-auto">
        <div class="card">
            <div class="card-header bg-light"><h5 class="mb-0">Totales de la Requisición</h5></div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <p class="mb-1">Subtotal: {{$Coins->symbol}} {{ number_format($Subtotal,2) }}</p>
                        <p class="mb-1">Iva: {{$Coins->symbol}} {{ number_format($Subtotal*(1-$InternalOrders->descuento)*0.16,2) }}</p>
                    </div>
                    <div class="col-md-6 text-end">
                        <p class="mb-1">Total: {{$Coins->symbol}} {{ number_format($InternalOrders->total,2) }}</p>
                        <p class="mb-1">Suma parcial: <strong id="monitor">0%</strong></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
                
                
</div>

@stop

@section('css')
    
@stop

@section('js')

@if ($actualized == 'SI')
<script type="text/javascript" src="{{ asset('vendor/mystylesjs/js/percentage_actualized.js') }}"></script>
@endif

@if ($actualized == 'NO')
<script type="text/javascript" src="{{ asset('vendor/mystylesjs/js/percentage_incorrect.js') }}"></script>
@endif


<script>
    const npagos = parseInt("{{$npagos}}") || 0;
    const totalRequisicion = parseFloat("{{$InternalOrders->total}}") || 0;
    let currentStep = 1;

    function calculateTotalPercentage() {
        let total = 0;
        for (let i = 1; i <= npagos; i++) {
            const valor = parseFloat(document.getElementById('P' + i).value || 0);
            if (!isNaN(valor)) {
                total += valor;
            }
        }
        return parseFloat(total.toFixed(2));
    }
    function updateProgressBar() {
        const totalPercent = calculateTotalPercentage();
        const progress = Math.min(Math.round(totalPercent), 100);
        const progressBar = document.getElementById('wizard-progress');
        if (progressBar) {
            progressBar.style.width = progress + '%';
            progressBar.setAttribute('aria-valuenow', progress);
            progressBar.textContent = progress + '%';
        }
    }
    function actualizarTotal() {
        const total = calculateTotalPercentage();
        const monitor = document.getElementById('monitor');
        if (monitor) {
            monitor.textContent = total.toFixed(2) + '%';
        }
        updateSummary();
        updateProgressBar();
        return total;
    }

    function updateSummary() {
        const summary = document.getElementById('summary-list');
        if (!summary) return;
        summary.innerHTML = '';

        for (let i = 1; i <= npagos; i++) {
            const porcentaje = parseFloat(document.getElementById('P' + i).value || 0).toFixed(2);
            const cantidad = parseFloat(document.getElementById('R' + i).value || 0).toFixed(2);
            const item = document.createElement('div');
            item.className = 'list-group-item d-flex justify-content-between align-items-center';
            item.innerHTML = `<span>Pago ${i}: ${porcentaje}%</span><strong>${cantidad}</strong>`;
            summary.appendChild(item);
        }
    }

    function updateWizardDisplay() {
        const steps = document.querySelectorAll('.payment-step');
        steps.forEach(step => {
            const stepNumber = parseInt(step.getAttribute('data-step'));
            step.style.display = stepNumber === currentStep ? 'block' : 'none';
        });

        updateProgressBar();
        const stepLabel = document.getElementById('wizard-step-label');
        const prevBtn = document.getElementById('btn-prev');
        const nextBtn = document.getElementById('btn-next');

       
        if (stepLabel) {
            stepLabel.textContent = `Paso ${currentStep} de ${npagos}`;
        }
        if (prevBtn) {
            prevBtn.disabled = currentStep === 1;
        }
        if (nextBtn) {
            if (currentStep === npagos) {
                nextBtn.innerHTML = 'Guardar <i class="fas fa-save"></i>';
                nextBtn.classList.remove('btn-success');
                nextBtn.classList.add('btn-primary');
            } else {
                nextBtn.innerHTML = 'Siguiente <i class="fas fa-arrow-right"></i>';
                nextBtn.classList.remove('btn-primary');
                nextBtn.classList.add('btn-success');
            }
        }
        actualizarTotal();
    }

    function validateStep(stepNumber) {
        const porcentaje = document.getElementById('P' + stepNumber);
        const fecha = document.getElementById('D' + stepNumber);
        const concepto = document.getElementById('C' + stepNumber);

        if (!porcentaje || !fecha || !concepto) return false;
        if (porcentaje.value === '' || isNaN(parseFloat(porcentaje.value)) || parseFloat(porcentaje.value) <= 0) {
            alert(`Ingrese un porcentaje válido para el pago ${stepNumber}`);
            porcentaje.focus();
            return false;
        }
        if (!fecha.value) {
            alert(`Ingrese la fecha del pago ${stepNumber}`);
            fecha.focus();
            return false;
        }
        if (!concepto.value.trim()) {
            alert(`Ingrese el concepto del pago ${stepNumber}`);
            concepto.focus();
            return false;
        }
        return true;
    }

    function nextPayment() {
        if (!validateStep(currentStep)) return;
        if (currentStep === npagos) {
            submitWizard();
            return;
        }
        currentStep++;
        updateWizardDisplay();
    }

    function prevPayment() {
        if (currentStep > 1) {
            currentStep--;
            updateWizardDisplay();
        }
    }

    function redondear() {
        const total = calculateTotalPercentage();
        const diferencia = 100 - total;
        const ultimo = document.getElementById('P' + npagos);
        const ultimoR = document.getElementById('R' + npagos);
        if (!ultimo) return;
        const nuevo = parseFloat(ultimo.value || 0) + diferencia;
        if (nuevo < 0) {
            alert('No se puede redondear, acerque más al 100%');
            return;
        }
        ultimo.value = nuevo.toFixed(2);
        if (ultimoR && !isNaN(totalRequisicion) && totalRequisicion > 0) {
            ultimoR.value = (nuevo * totalRequisicion / 100).toFixed(2);
        }
        actualizarTotal();
    }

    function submitWizard() {
        const total = calculateTotalPercentage();
        if (total < 99.99 || total > 100.01) {
            alert('Los porcentajes deben sumar 100%');
            return;
        }
        for (let i = 1; i <= npagos; i++) {
            if (!validateStep(i)) {
                currentStep = i;
                updateWizardDisplay();
                return;
            }
        }
        document.getElementById('form1').submit();
    }

    function attachSyncListeners(index) {
        const porcentaje = document.getElementById('P' + index);
        const cantidad = document.getElementById('R' + index);
        if (!porcentaje || !cantidad) return;
        porcentaje.addEventListener('input', function () {
            if (!isNaN(totalRequisicion) && totalRequisicion > 0) {
                cantidad.value = (parseFloat(this.value || 0) * totalRequisicion / 100).toFixed(2);
            }
            actualizarTotal();
        });
        cantidad.addEventListener('input', function () {
            if (!isNaN(totalRequisicion) && totalRequisicion > 0) {
                porcentaje.value = ((parseFloat(this.value || 0) / totalRequisicion) * 100).toFixed(2);
            }
            actualizarTotal();
        });
    }

    document.addEventListener('DOMContentLoaded', function () {
        for (let i = 1; i <= npagos; i++) {
            attachSyncListeners(i);
        }
        updateWizardDisplay();
        $('.date').datetimepicker({
            format: 'MM/DD/YYYY',
            locale: 'en'
        });
    });
</script>
@stop