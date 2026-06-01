@extends('adminlte::page')

@section('title', 'PROVEEDORES')

@section('content_header')
    <h1 class="font-bold"><i class="fas fa-users-cog"></i>&nbsp; Proveedor</h1>
@stop

@section('content')
    <div class="container bg-gray-300 shadow-lg rounded-lg">
        <div class="row rounded-b-none rounded-t-lg shadow-xl bg-white">
            <h5 class="card-title p-2">
                <i class="fas fa-plus-circle"></i>&nbsp; Agregar Proveedor:
            </h5>
        </div>
        <form action="{{ route('providers.store')}}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row rounded-b-lg rounded-t-none mb-4 shadow-xl bg-gray-300">
            <div class="row p-4">
                <div class="col-sm-6 col-xs-12 shadow rounded-xl p4">
                    <div class="card">
                        <div class="card-header">
                            <h1 class="h5 text-center fw">Datos Generales</h1>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <x-jet-label value="* Tipo de Persona" />
                                <div class="flex items-center gap-4 mt-1">
                                    <label class="inline-flex items-center">
                                        <input type="radio" name="person_type" value="moral" id="person_moral" checked class="form-radio" />
                                        <span class="ml-2">Persona Moral</span>
                                    </label>
                                    <label class="inline-flex items-center">
                                        <input type="radio" name="person_type" value="fisica" id="person_fisica" class="form-radio" />
                                        <span class="ml-2">Persona Física</span>
                                    </label>
                                </div>
                            </div>

                            <div class="form-group" id="razon_social_group">
                                <x-jet-label value="* Nombre o Razón Social" />
                                <x-jet-input type="text" name="customer" class="w-full text-xs " value="{{old('customer')}}" onkeyup="javascript:this.value=this.value.toUpperCase();"/>
                                <x-jet-input-error for='customer' />
                            </div>

                            <div class="form-group" id="fisica_name_group" style="display: none;">
                                <x-jet-label value="* Apellido Paterno" />
                                <x-jet-input type="text" name="last_name1" id="last_name1" class="w-full text-xs " value="{{old('last_name1')}}" onkeyup="javascript:this.value=this.value.toUpperCase();"/>
                                <x-jet-input-error for='last_name1' />
                                <x-jet-label value="* Apellido Materno" />
                                <x-jet-input type="text" name="last_name2" id="last_name2" class="w-full text-xs " value="{{old('last_name2')}}" onkeyup="javascript:this.value=this.value.toUpperCase();"/>
                                <x-jet-input-error for='last_name2' />
                                <x-jet-label value="* Nombre" />
                                <x-jet-input type="text" name="first_name" id="first_name" class="w-full text-xs " value="{{old('first_name')}}" onkeyup="javascript:this.value=this.value.toUpperCase();"/>
                                <x-jet-input-error for='first_name' />
                            </div>

                            <div class="form-group" id="legal_name_group">
                                <x-jet-label value="* Regimen de Capital" />
                                <select class="form-capture  w-full text-xs uppercase" id="legal_name" name="legal_name">
                                
                                    <option value="FISICA CAEYP" > PERSONA FISICA CON ACTIVIDADES EMPRESARIALES Y PROFESIONALES </option>
                                    <option value="S.A." >SOCIEDAD ANONIMA </option>
                                    <option value="S.A. DE C.V." > SOCIEDAD ANONIMA DE CAPITAL VARIABLE </option>
                                    <option value="S DE R.L DE C.V." >SOCIEDAD DE RESPONSABILIDAD LIMITADA DE CAPITAL VARIABLE </option>
                                    <option value="SAPI" >SOCIEDAD ANONIMA PROMOTORA DE INVERSION </option>
                                    <option value="SAPI DE C.V." > SOCIEDAD ANONIMA PROMOTORA DE INVERSION DE CAPITAL VARIABLE</option>
                                    <option value="SAS" > SOCIEDAD POR ACCIONES SIMPLIFICADA</option>
                                    <option value="S.C" >SOCIEDAD COOPERATIVA </option>
                                    <option value="S en N. C" > SOCIEDAD EN NOMBRE COLECTIVO</option>
                                    <option value="S en N. C DE C.V." > SOCIEDAD EN NOMBRE COLECTIVO DE CAPITAL VARIABLE S en N. C DE C.V</option>
                                    <option value="S en C" >SOCIEDAD EN COMANDITA SIMPLE </option>
                                    <option value="S.C.A" >SOCIEDAD EN COMANDITA POR ACCIONES </option>
                                    
                                    <option value="R.S.C" >REGIMEN SIMPLIFICADO DE CONFIANZA </option>
                                    <option value="POR ASIGNAR" >POR ASIGNAR </option>
                                    <option value="otra" >OTRA </option>
                                    <option value="" > </option>
                                    
                                    
                                </select>
                                <br>
                                <x-jet-input type="text" name="otra" id='otra' class="w-full text-xs " style='display: none;' onkeyup="javascript:this.value=this.value.toUpperCase();"/>
                                
                                <x-jet-input-error for='legal_name' />
                            </div>
                            <div class="form-group">
                                <x-jet-label value="* Nombre Corto" />
                                <x-jet-input type="text" name="alias" class="w-full text-xs " value="{{old('alias')}}" onkeyup="javascript:this.value=this.value.toUpperCase();"/>
                                <x-jet-input-error for='alias' />
                            </div>
                            <div class="form-group">
                                <x-jet-label value="* RFC" />
                                <x-jet-input type="text" name="customer_rfc" class="w-full text-xs " value="{{old('customer_rfc')}}"/>
                                <x-jet-input-error for='customer_rfc' />
                            </div>
                            <div class="form-group" id="regimen_fiscal_group" style="display: none;">
                                <x-jet-label value="* Regimen Fiscal" />
                                <select class="form-capture  w-full text-xs uppercase" id="regimen_fiscal" name="regimen_fiscal">

                                    <option value="" > </option>
                                    <option value="601" @if(old('regimen_fiscal')=='601') selected @endif>601 - REGIMEN GENERAL DE LEY PERSONAS MORALES</option>
                                    <option value="602" @if(old('regimen_fiscal')=='602') selected @endif>602 - RÉGIMEN SIMPLIFICADO DE LEY PERSONAS MORALES</option>
                                    <option value="603" @if(old('regimen_fiscal')=='603') selected @endif>603 - PERSONAS MORALES CON FINES NO LUCRATIVOS</option>
                                    <option value="604" @if(old('regimen_fiscal')=='604') selected @endif>604 - RÉGIMEN DE PEQUEÑOS CONTRIBUYENTES</option>
                                    <option value="605" @if(old('regimen_fiscal')=='605') selected @endif>605 - RÉGIMEN DE SUELDOS Y SALARIOS E INGRESOS ASIMILADOS A SALARIOS</option>
                                    <option value="606" @if(old('regimen_fiscal')=='606') selected @endif>606 - RÉGIMEN DE ARRENDAMIENTO</option>
                                    <option value="607" @if(old('regimen_fiscal')=='607') selected @endif>607 - RÉGIMEN DE ENAJENACIÓN O ADQUISICIÓN DE BIENES</option>
                                    <option value="608" @if(old('regimen_fiscal')=='608') selected @endif>608 - RÉGIMEN DE LOS DEMÁS INGRESOS</option>
                                    <option value="609" @if(old('regimen_fiscal')=='609') selected @endif>609 - RÉGIMEN DE CONSOLIDACIÓN</option>
                                    <option value="610" @if(old('regimen_fiscal')=='610') selected @endif>610 - RÉGIMEN RESIDENTES EN EL EXTRANJERO SIN ESTABLECIMIENTO PERMANENTE EN MÉXICO</option>
                                    <option value="611" @if(old('regimen_fiscal')=='611') selected @endif>611 - RÉGIMEN DE INGRESOS POR DIVIDENDOS (SOCIOS Y ACCIONISTAS)</option>
                                    <option value="612" @if(old('regimen_fiscal')=='612') selected @endif>612 - RÉGIMEN DE LAS PERSONAS FÍSICAS CON ACTIVIDADES EMPRESARIALES Y PROFESIONALES</option>
                                    <option value="613" @if(old('regimen_fiscal')=='613') selected @endif>613 - RÉGIMEN INTERMEDIO DE LAS PERSONAS FÍSICAS CON ACTIVIDADES EMPRESARIALES</option>
                                    <option value="614" @if(old('regimen_fiscal')=='614') selected @endif>614 - RÉGIMEN DE LOS INGRESOS POR INTERESES</option>
                                    <option value="615" @if(old('regimen_fiscal')=='615') selected @endif>615 - RÉGIMEN DE LOS INGRESOS POR OBTENCIÓN DE PREMIOS</option>
                                    <option value="616" @if(old('regimen_fiscal')=='616') selected @endif>616 - SIN OBLIGACIONES FISCALES</option>
                                    <option value="617" @if(old('regimen_fiscal')=='617') selected @endif>617 - PEMEX</option>
                                    <option value="618" @if(old('regimen_fiscal')=='618') selected @endif>618 - RÉGIMEN SIMPLIFICADO DE LEY PERSONAS FÍSICAS</option>
                                    <option value="619" @if(old('regimen_fiscal')=='619') selected @endif>619 - INGRESOS POR LA OBTENCIÓN DE PRÉSTAMOS</option>
                                    <option value="620" @if(old('regimen_fiscal')=='620') selected @endif>620 - SOCIEDADES COOPERATIVAS DE PRODUCCIÓN QUE OPTAN POR DIFERIR SUS INGRESOS</option>
                                    <option value="621" @if(old('regimen_fiscal')=='621') selected @endif>621 - RÉGIMEN DE INCORPORACIÓN FISCAL</option>
                                    <option value="622" @if(old('regimen_fiscal')=='622') selected @endif>622 - RÉGIMEN DE ACTIVIDADES AGRÍCOLAS, GANADERAS, SILVÍCOLAS Y PESQUERAS PM</option>
                                    <option value="623" @if(old('regimen_fiscal')=='623') selected @endif>623 - RÉGIMEN DE OPCIONAL PARA GRUPOS DE SOCIEDADES</option>
                                    <option value="624" @if(old('regimen_fiscal')=='624') selected @endif>624 - RÉGIMEN DE LOS COORDINADOS</option>
                                    <option value="625" @if(old('regimen_fiscal')=='625') selected @endif>625 - RÉGIMEN DE LAS ACTIVIDADES EMPRESARIALES CON INGRESOS A TRAVÉS DE PLATAFORMAS TECNOLÓGICAS</option>
                                    <option value="626" @if(old('regimen_fiscal')=='626') selected @endif>626 - RÉGIMEN SIMPLIFICADO DE CONFIANZA</option>
                                    
                                    
                                </select>
                                
                                <x-jet-input-error for='regimen_fiscal' />
                            </div>
                            <div class="form-group">
                                <x-jet-label value=" Clave Proveedor" />
                                <x-jet-input type="text" name="clave" class="w-full text-xs " value="{{old('clave')}}" required />
                                <x-jet-input-error for='clave' />
                            </div>
                            <div class="form-group">
                                <x-jet-label value="* Email Coorporativo" />
                                <x-jet-input type="text" name="customer_email" class="w-full text-xs " value="{{old('customer_email')}}"/>
                                <x-jet-input-error for='customer_email' />
                            </div>
                            <div class="form-group">
                                <x-jet-label value="* Teléfono fiscal" />
                                <x-jet-input type="text" name="customer_telephone" class="w-full text-xs " value="{{old('customer_telephone')}}"/>
                                <x-jet-input-error for='customer_telephone' />
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-xs-12 shadow rounded-xl p4">
                    <div class="card">
                        <div class="card-header">
                            <h1 class="h5 text-center fw">Domicilio Fiscal</h1>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <x-jet-label value="* Estado" />
                                <x-jet-input type="text" name="customer_state" class="w-full text-xs " value="{{old('customer_state')}}" onkeyup="javascript:this.value=this.value.toUpperCase();"/>
                                <x-jet-input-error for='customer_state' />
                            </div>
                            <div class="form-group">
                                <x-jet-label value="* Ciudad" />
                                <x-jet-input type="text" name="customer_city" class="w-full text-xs " value="{{old('customer_city')}}" onkeyup="javascript:this.value=this.value.toUpperCase();"/>
                                <x-jet-input-error for='customer_city' />
                            </div>
                            <div class="form-group">
                                <x-jet-label value="* Colonia" />
                                <x-jet-input type="text" name="customer_suburb" class="w-full text-xs " value="{{old('customer_suburb')}}" onkeyup="javascript:this.value=this.value.toUpperCase();"/>
                                <x-jet-input-error for='customer_suburb' />
                            </div>
                            <div class="form-group">
                                <x-jet-label value="* Calle" />
                                <x-jet-input type="text" name="customer_street" class="w-full text-xs " value="{{old('customer_street')}}" onkeyup="javascript:this.value=this.value.toUpperCase();"/>
                                <x-jet-input-error for='customer_street' />
                            </div>
                            <div class="form-group">
                                <x-jet-label value="* Número Exterior" />
                                <x-jet-input type="text" name="customer_outdoor" class="w-full text-xs " value="{{old('customer_outdoor')}}" />
                                <x-jet-input-error for='customer_outdoor' />
                            </div>
                            <div class="form-group">
                                <x-jet-label value="Número Interior" />
                                <x-jet-input type="text" name="customer_indoor" class="w-full text-xs " value="{{old('customer_indoor')}}"/>
                                <x-jet-input-error for='customer_indoor' />
                            </div>
                            <div class="form-group">
                                <x-jet-label value="* C.P." />
                                <x-jet-input type="text" name="customer_zip_code" class="w-full text-xs " value="{{old('customer_zip_code')}}"/>
                                <x-jet-input-error for='customer_zip_code' />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 text-right p-2 gap-2">
                <a href="{{ route('providers.index')}}" class="btn btn-black mb-2">
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
        function updatePersonType(){
            var type = $('input[name="person_type"]:checked').val();
            if(type === 'fisica'){
                $('#razon_social_group').hide();
                $('#legal_name_group').hide();
                $('#fisica_name_group').show();
                $('#regimen_fiscal_group').show();
            } else {
                $('#razon_social_group').show();
                $('#legal_name_group').show();
                $('#fisica_name_group').hide();
                $('#regimen_fiscal_group').hide();
            }
        }

        // initial setup
        updatePersonType();

        // toggle when radio changes
        $('input[name="person_type"]').change(function(){
            updatePersonType();
        });

        // show/hide 'otra' for legal_name select
        $('#legal_name').change(function(){
            var seleccionado = $(this).val();
            if(seleccionado=='otra'){
                document.getElementById('otra').style.display="block";
            }
            else{
                document.getElementById('otra').style.display="none"; 
            }
        });

        // ensure 'customer' contains full name for persona fisica on submit
        $('form').on('submit', function(){
            if($('input[name="person_type"]:checked').val() === 'fisica'){
                var fn = ($('#first_name').val()||'').trim();
                var ln = ($('#last_name').val()||'').trim();
                var full = (fn + ' ' + ln).trim();
                $('input[name="customer"]').val(full);
            }
        });

    });
</script>
@stop