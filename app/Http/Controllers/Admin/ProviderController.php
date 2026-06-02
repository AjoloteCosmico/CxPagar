<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Provider;
use App\Models\CustomerContact;
use Illuminate\Http\Request;
use DB;
use Session;
class ProviderController extends Controller
{
    public function index()
    {
        $Providers = Provider::all();

        return view('admin.providers.index', compact(
            'Providers',
        ));
    }
    public function create(){
        return view('admin.providers.create');
    }

    public function validar_rfc()
    {
        return view('admin.providers.rfc');
    }
    public function rfc(Request $request)
    {
        $rules = ['customer_rfc' => 'required|max:13'];
        $messages = ['customer_rfc.required' => 'Capture el RFC del Proveedor'];
        $request->validate($rules, $messages);
        
        $hayproveedor=Provider::where('customer_rfc',$request->customer_rfc)->first();
        if($hayproveedor){
            return redirect('admin/providers/'.$hayproveedor->id.'/edit')->with('message', 'ok');
        }else{
            $rfc=$request->customer_rfc;
            return redirect('admin/providers/create')->with('rfc', $rfc);
        }
    }

    public function store(Request $request)
    {
        
        $rules = [
            'customer' => 'required',
            'alias' => 'required',
            'clave' => 'required|unique:providers',
            'legal_name' => 'required',
            'customer_rfc' => 'required|max:13|unique:providers',
            'customer_state' => 'required',
            'customer_city' => 'required',
            'customer_suburb' => 'required',
            'customer_street' => 'required',
            'customer_outdoor' => 'required',
            'customer_zip_code' => 'required|max:5',
            'customer_email' => 'required|email',
            'customer_telephone' => 'required|max:10',
        ];

        $messages = [
            'customer.required' => 'Escriba el Nombre del Proveedor',
            'clave.required' => 'Escriba la Clave del Proveedor',
            'clave.unique' => 'La Clave del Proveedor ya existe, escriba una diferente',
            'alias.required' => 'Escriba el Nombre Corto del Proveedor',
            'legal_name.required' => 'Escriba el Nombre Jurídico del Proveedor',
            'alias.required' => 'Escriba el Nombre Corto del Proveedor',
            'customer_rfc.required' => 'Capture el RFC del Proveedor',
            'customer_rfc.max' => 'Sólo puede capturar un máximo de 13 caractéres',
            'customer_rfc.unique' => 'El RFC del Proveedor ya existe, escriba uno diferente',
            'customer_state.required' => 'Capture el Estado donde se ubica el Proveedor',
            'customer_city.required' => 'Capture la Ciudad donde se ubica el Proveedor',
            'customer_suburb.required' => 'Capture la Colonia donde se ubica el Proveedor',
            'customer_street.required' => 'Capture la dirección donde se ubica el Proveedor',
            'customer_outdoor.required' => 'Capture el Número Exterior donde se ubica el Proveedor',
            'customer_email.required' => 'Capture la dirección electrónica del Proveedor',
            'customer_email.email' => 'Capture una dirección de Email válida',
            'customer_telephone.required' => 'Capture el Número telefónico del Proveedor',
            'customer_telephone.max' => 'Capture el Número telefónico a 10 dígitos',
            'customer_zip_code.required' => 'Capture el Código Postal del Proveedor',
            'customer_zip_code.max' => 'Sólo puede capturar un máximo de 5 caractéres'
        ];
        
        $request->validate($rules, $messages);
        
        $Providers = new Provider();
        $Providers->customer = $request->customer;
        if($request->legal_name == 'otra'){
            $Providers->legal_name = $request->otra;
        }
        else{
            $Providers->legal_name = $request->legal_name;
        }
        $Providers->person_type=$request->person_type;
        $Providers->alias = $request->alias;
        $Providers->customer_rfc = $request->customer_rfc;
        $Providers->regimen_fiscal=$request->regimen_fiscal;
        $Providers->customer_state = $request->customer_state;
        $Providers->customer_city = $request->customer_city;
        $Providers->customer_suburb = $request->customer_suburb;
        $Providers->customer_street = $request->customer_street;
        $Providers->customer_outdoor = $request->customer_outdoor;
        $Providers->customer_indoor = $request->customer_indoor;
        $Providers->customer_zip_code = $request->customer_zip_code;
        $Providers->customer_email = $request->customer_email;
        $Providers->customer_telephone = $request->customer_telephone;
        $Providers->clave=$request->clave;
        $Providers->save();

        return redirect()->route('providers.index')->with('create_reg', 'ok');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $Regimenes=DB::table('regimenes')->get();
        $Providers = Provider::find($id);
        $Contacts = CustomerContact::where('customer_id', $id)->get();
        $nc=$Contacts->count();
        return view('admin.providers.show', compact(
            'Providers', 
            'Contacts',
            'nc','Regimenes'
        ));
    }

    public function update(Request $request, $id)
    {        
        $rules = [
            'customer' => 'required',
            'alias' => 'required',
            'customer_rfc' => 'required|max:13',
            'customer_state' => 'required',
            'customer_city' => 'required',
            'customer_suburb' => 'required',
            'customer_street' => 'required',
            'customer_outdoor' => 'required',
            'customer_email' => 'required|email',
            'customer_telephone' => 'required|max:10',
            'customer_zip_code' => 'required|max:5',
        ];

        $messages = [
            'customer.required' => 'Escriba el Nombre del Proveedor',
            'alias.required' => 'Escriba el Nombre Corto del Proveedor',
            'customer_rfc.required' => 'Capture el RFC del Proveedor',
            'customer_rfc.max' => 'Sólo puede capturar un máximo de 13 caractéres',
            'customer_state.required' => 'Capture el Estado donde se ubica el Proveedor',
            'customer_city.required' => 'Capture la Ciudad donde se ubica el Proveedor',
            'customer_suburb.required' => 'Capture la Colonia donde se ubica el Proveedor',
            'customer_street.required' => 'Capture la dirección donde se ubica el Proveedor',
            'customer_outdoor.required' => 'Capture el Número Exterior donde se ubica el Proveedor',
            'customer_email.required' => 'Capture la dirección electrónica del Proveedor',
            'customer_email.email' => 'Capture una dirección de Email válida',
            'customer_telephone.required' => 'Capture el Número telefónico del Proveedor',
            'customer_telephone.max' => 'Capture el Número telefónico a 10 dígitos',
            'customer_zip_code.required' => 'Capture el Código Postal del Proveedor',
            'customer_zip_code.max' => 'Sólo puede capturar un máximo de 5 caractéres'
        ];

        $request->validate($rules, $messages);

        $Providers = Provider::where('id', $id)->first();
        $Providers->customer = $request->customer;
        if($request->legal_name == 'otra'){
            $Providers->legal_name = $request->otra;
        }
        else{
            $Providers->legal_name = $request->legal_name;}
        $Providers->alias = $request->alias;
        $Providers->customer_rfc = $request->customer_rfc;
        $Providers->customer_state = $request->customer_state;
        $Providers->customer_city = $request->customer_city;
        $Providers->customer_suburb = $request->customer_suburb;
        $Providers->customer_street = $request->customer_street;
        $Providers->customer_outdoor = $request->customer_outdoor;
        $Providers->customer_indoor = $request->customer_indoor;
        $Providers->customer_zip_code = $request->customer_zip_code;
        $Providers->customer_email = $request->customer_email;
        $Providers->customer_telephone = $request->customer_telephone;
        $Providers->save();

        return redirect()->route('providers.index')->with('update_reg', 'ok');
    }

    public function destroy($id)
    {
        Provider::destroy($id);

        return redirect()->route('providers.index')->with('eliminar', 'ok');
    }

    public function contacto( $id)
    {
        $Contacts = CustomerContact::where('customer_id', $id);
        $Provider = Provider::where('id', $id)->first();
        
        return view('admin.customer_contacts.create', compact(
            'Contacts',
            'Provider'
            ));

    }
    public function store_contact(Request $request)
    {
        $rules = [
            'customer_contact_name' => 'required',
            'customer_state' => 'required',
            'customer_city' => 'required',
            'customer_suburb' => 'required',
            'customer_street' => 'required',
            'customer_outdoor' => 'required',
            'customer_zip_code' => 'required|max:5',
            'customer_email' => 'required|email',
            'customer_telephone' => 'required|max:10',
            'customer_mobile' => 'required|max:10',
        ];

        $messages = [
            'customer_contact_name.required' => 'Escriba el Nombre del Contacto',
            'customer_state.required' => 'Capture el Estado donde se ubica el Contacto',
            'customer_city.required' => 'Capture la Ciudad donde se ubica el Contacto',
            'customer_suburb.required' => 'Capture la Colonia donde se ubica el Contacto',
            'customer_street.required' => 'Capture la dirección donde se ubica el Contacto',
            'customer_outdoor.required' => 'Capture el Número Exterior donde se ubica el Contacto',
            'customer_email.required' => 'Capture la dirección electrónica del Contacto',
            'customer_email.email' => 'Capture una dirección de Email válida',
            'customer_telephone.required' => 'Capture el Número telefónico del Contacto',
            'customer_telephone.max' => 'Capture el Número telefónico a 10 dígitos',
            'customer_zip_code.required' => 'Capture el Código Postal del Contacto',
            'customer_zip_code.max' => 'Sólo puede capturar un máximo de 5 caractéres',
            'customer_mobile.required' => 'Capture el Número telefónico del Contacto',
            'customer_mobile.max' => 'Capture el Número telefónico a 10 dígitos',
        ];

        $request->validate($rules, $messages);
        $CustomersContact = new CustomerContact();
        $CustomersContact->customer_contact_name = $request->customer_contact_name;
        $CustomersContact->customer_contact_state = $request->customer_state;
        $CustomersContact->customer_contact_city = $request->customer_city;
        $CustomersContact->customer_contact_suburb = $request->customer_suburb;
        $CustomersContact->customer_contact_street = $request->customer_street;
        $CustomersContact->customer_contact_outdoor = $request->customer_outdoor;
        $CustomersContact->customer_contact_indoor = $request->customer_indoor;
        $CustomersContact->customer_contact_zip_code = $request->customer_zip_code;
        $CustomersContact->customer_contact_email = $request->customer_email;
        $CustomersContact->customer_contact_personal_email = $request->customer_personal_email;
        $CustomersContact->customer_contact_office_phone = $request->customer_telephone;
        $CustomersContact->customer_contact_office_phone_ext = $request->customer_telephone_ext;
        $CustomersContact->customer_contact_mobile = $request->customer_mobile;
        $CustomersContact->customer_id = $request->customer_id;
        $CustomersContact->save();
        return redirect()->route('providers.edit',$request->customer_id);
    }

    public function autocomplete(Request $request)
    {
        $data = Provider::select("customer")
                    ->where('customer', 'LIKE', '%'. $request->get('query'). '%')
                    ->get();
        return response()->json($data);
    }

}
