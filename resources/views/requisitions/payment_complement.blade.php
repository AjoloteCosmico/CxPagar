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
<p style ="font-size:250%;">TABLA PROMESA DE PAGO</p>
<br>
<h2 style='color:#2C426C; font-size: 150%'>* Todos los pagos incluyen IVA</h2>
<br><br>
<form action="{{ route('requisition.store_payment_complement', $InternalOrders->id) }}" method="POST" enctype="multipart/form-data" id="form1">
@csrf
<x-jet-input type="hidden" name="rowcount" id="rowcount" value="{{$npagos}}"/>
<x-jet-input type="hidden" name="customerID" value="{{$InternalOrders->customer_id}}" />
<x-jet-input type="hidden" name="sellerID" value="{{$InternalOrders->seller_id}}"/>
<x-jet-input type="hidden" name="customerAdressID" value="{{$InternalOrders->customer_shipping_address_id}}"/>
<x-jet-input type="hidden" name="coinID" value="{{$InternalOrders->coin_id}}"/>
<x-jet-input type="hidden" name="total" id="total" value="{{$InternalOrders->total}}"/>
<x-jet-input type="hidden" name="order_id" value="{{$InternalOrders->id}}"/>
<table class="table table-striped" name="tabla1" id="tabla1">
  <thead class="thead">
    <tr>
      <th scope="col">Entregable</th>
      <th scope="col">Forma de pago</th>
      <th scope="col">No. Cuenta</th>
      <th scope="col">Hora de recibido</th>
      <th scope="col">Condiciones de entrega</th>
    </tr>
  </thead>
  <tbody>

   
   @foreach ($Payments as $payment)
    
    
    <tr>
        <x-jet-input type="hidden" name="payment_id[]" value="{{$payment->id}}" />
        <td>{{ 'PAGO ' . $loop->iteration }}</td>
        <td> <input type='text' required style='width: 70%;' name="forma_pago[{{$loop->index}}]" id="P{{$loop->iteration}}"></td>
        <td> <input type='text' required name="no_cuenta[{{$loop->index}}]" id="R{{$loop->iteration}}" style='width: 70%;'></td>
        <td> <input type='time' required class='w-full text-xs date' name="hora_recibido[{{$loop->index}}]" id="D{{$loop->iteration}}"></td>
        <td> <input type='text' style='width: 50%;' name="condiciones[{{$loop->index}}]" onkeyup="javascript:this.value=this.value.toUpperCase();"></td>
        
     </tr>
      

      @endforeach
    <tr >
    <th rowspan="3" scope="row">TOTALES: </th>  
    <td> Subtotal: {{$Coins -> symbol}} {{ number_format($Subtotal,2)}}</td>
    <td> SUMA:</td>
    </tr>
    <tr>
    <td> Iva: {{$Coins -> symbol}} {{number_format( $Subtotal*(1-$InternalOrders->descuento)*0.16,2)}}</td>
    <td id="monitor">
    </td>
    </tr>
    <tr>
    <td> Total: {{$Coins -> symbol}} {{number_format( $InternalOrders->total,2)}}</td>
    
    </tr>
    
    </tbody>
</table>

<!--
      <td> <span><button type="button" onclick="myFunction()"  class="btn btn-blue mb-2"> </span>
      <i class="fa fa-plus" ></i>
      &nbsp; &nbsp;
      <p>Agregar Concepto</p></button></td>-->
      
  
  
 
    <br><br>

    <button   type="submit" class="btn btn-green mb-2" >
                <i class="fas fa-save fa-2x" ></i>
                         &nbsp; &nbsp;
                <p>Guardar Porcentaje de Avance</p></button>
 

                </div>
                </form>
                
                
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
  function actualizarTotal(){
    var npagos=parseInt("{{$npagos}}");
    var total = 0;
    for (var i = 1; i <= npagos; i++) {
      valor=document.getElementById("P"+i).value;
      if( parseFloat(valor)>0){
      total=total+ parseFloat(valor);}
    }
document.getElementById("monitor").innerHTML=String(parseFloat(total))+'%';
  }
</script>

@for ($i = 1; $i <= $npagos; $i++)
<script>
 document.getElementById("{{'R'.$i}}").addEventListener("input", function(){
  total = parseFloat(document.getElementById('total').value);
    document.getElementById("{{'P'.$i}}").value = (this.value/total)*100;
    actualizarTotal();
    }); 
    
     document.getElementById("{{'P'.$i}}").addEventListener("input", function(){
      total = parseFloat(document.getElementById('total').value);
      document.getElementById("{{'R'.$i}}").value = parseFloat(this.value*total*0.01).toFixed(2);
      actualizarTotal();
    });
</script>
@endfor



<script>
$(document).ready(function () {
  $('.date').datetimepicker({
    format: 'MM/DD/YYYY',
    locale: 'en'
  });
});
</script>
@stop