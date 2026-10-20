<?php

namespace App\Http\Controllers;
use Session;
use App\Models\TempItem;
use App\Models\Customer;
use App\Models\Family;
use App\Models\TempInternalOrder;
use App\Models\Unit;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TempItemController extends Controller
{
    public function index()
    {
        //
    }

    public function create()
    {
      //
    }

    public function create_item($id,Request $request)
    {
        $cat=$request->session_cat;
        //$p_comission=$request->p_comission;
            if($cat!='.'){
               
            session(['cat' => $cat]);
            }
        $desc=$request->session_desc;
            //$p_comission=$request->p_comission;
                if($desc!='.'){
                   
                session(['desc' => $desc]);
                }
        $obs=$request->session_obs;
                //$p_comission=$request->p_comission;
                    if($obs!='.'){
                       
                    session(['obs' => $obs]);
                    }


        $TempInternalOrders = $id;
        $TempItems = TempItem::where('temp_internal_order_id', $id)->OrderBy('id', 'DESC')->first();

        if($TempItems){
            $Item = $TempItems->item + 1;
        }else{
            $Item = 1;
        }

        $Units = Unit::all();
        $Families = Family::all();

        $productTypes = DB::table('products')
    ->whereNotNull('type')
    ->where('type', '!=', '')        // filtra NULL y '' en BD
    ->distinct()
    ->orderBy('type')
    ->pluck('type')                   // ya define la columna, quita select('type')
    ->map(fn ($value) => trim((string) $value))
    ->filter(fn ($value) => $value !== '')  // <- callback explícito: "0" se conserva
    ->unique()                        // deduplica después del trim
    ->values()
    ->all();

          

        $productsByType = DB::table('products')
            ->select(['id', 'type', 'product', 'family', 'public_price', 'iva', 'ieps', 'isr', 'retention_iva', 'retention_isr', 'other_retentions'])
            ->whereNotNull('type')
            ->where('type', '!=', '')
            ->orderBy('type')
            ->orderBy('product')
            ->get()
            ->groupBy('type')
            ->map(function ($products) {
                return collect($products)->map(function ($product) {
                    return [
                        'id' => $product->id,
                        'product' => $product->product,
                        'family' => $product->family,
                        'public_price' => (float) ($product->public_price ?? 0),
                        'iva' => (float) ($product->iva ?? 0),
                        'ieps' => (float) ($product->ieps ?? 0),
                        'isr' => (float) ($product->isr ?? 0),
                        'retention_iva' => (float) ($product->retention_iva ?? 0),
                        'retention_isr' => (float) ($product->retention_isr ?? 0),
                        'other_retentions' => (float) ($product->other_retentions ?? 0),
                    ];
                })->values()->all();
            })
            ->all();

        return view('admin.items.create', compact(
            'TempInternalOrders',
            'Item',
            'Units',
            'Families',
            'productTypes',
            'productsByType'
        ));
    }

    public function edit_item($id,$captured)
    {
        $Id=$id;
        $Captured=$captured;
        $Item = TempItem::find($id);
        $Units = Unit::all();
        $Families = Family::all();
        $TempInternalOrders = $Item->temp_internal_order_id;

        $productTypes = DB::table('products')
            ->select('type')
            ->whereNotNull('type')
            ->where('type', '!=', '')
            ->distinct()
            ->orderBy('type')
            ->pluck('type')
            ->map(fn ($value) => trim((string) $value))
            ->filter()
            ->values()
            ->all();

        $productsByType = DB::table('products')
            ->select(['id', 'type', 'product', 'family', 'public_price', 'iva', 'ieps', 'isr', 'retention_iva', 'retention_isr', 'other_retentions'])
            ->whereNotNull('type')
            ->where('type', '!=', '')
            ->orderBy('type')
            ->orderBy('product')
            ->get()
            ->groupBy('type')
            ->map(function ($products) {
                return collect($products)->map(function ($product) {
                    return [
                        'id' => $product->id,
                        'product' => $product->product,
                        'family' => $product->family,
                        'public_price' => (float) ($product->public_price ?? 0),
                        'iva' => (float) ($product->iva ?? 0),
                        'ieps' => (float) ($product->ieps ?? 0),
                        'isr' => (float) ($product->isr ?? 0),
                        'retention_iva' => (float) ($product->retention_iva ?? 0),
                        'retention_isr' => (float) ($product->retention_isr ?? 0),
                        'other_retentions' => (float) ($product->other_retentions ?? 0),
                    ];
                })->values()->all();
            })
            ->all();

        return view('admin.items.edit', compact(
            'TempInternalOrders',
            'Item',
            'Units',
            'Families',
            'Id',
            'Captured',
            'productTypes',
            'productsByType'
        ));
    }

    public function store(Request $request)
    {
        
        $rules = [
            'amount' => 'required',
            'unit' => 'required',
            // 'family' => 'required',
            
            'sku' => 'required',
            'description' => 'required',
            'unit_price' => 'required',
        ];

        $messages = [
            'amount.required' => 'La Cantidad es requerida',
            'unit.required' => 'La unidad es requerida',
            'family.required' => 'La familia es requerida',
            
            
            'sku.required' => 'SKU requerido',
            'description.required' => 'La descripción es requerida',
            'unit_price.required' => 'El precio unitario es requerido',
        ];

        $request->validate($rules, $messages);
        
        $Import = $request->amount * $request->unit_price;

        $TempItems = TempItem::where('item', $request->item)->first();
        if($TempItems){
            $TempItems->delete();
        }
        
            $TempItems = new TempItem();
            $TempItems->temp_internal_order_id = $request->temp_internal_order_id;
            $TempItems->item = $request->item;
            $TempItems->amount = $request->amount;
            $TempItems->unit = $request->unit;
            $Producto = null;
            if($request->product && $request->product !== 'OTRO'){
                $Producto = Product::find($request->product);
            }
            if($Producto) {
                $TempItems->producto = $Producto->product;
                $TempItems->family = $Producto->family;
                $TempItems->iva = (float) ($Producto->iva ?? 0);
                $TempItems->ieps = (float) ($Producto->ieps ?? 0);
                $TempItems->isr = (float) ($Producto->isr ?? 0);
                $TempItems->retencion_iva = (float) ($Producto->retention_iva ?? 0);
                $TempItems->retencion_isr = (float) ($Producto->retention_isr ?? 0);
                $TempItems->other_retentions = (float) ($Producto->other_retentions ?? 0);
                $TempItems->retencion = (float) (($Producto->retention_iva ?? 0) + ($Producto->retention_isr ?? 0) + ($Producto->other_retentions ?? 0));
            } else {
                $TempItems->producto = $request->otro ?? null;
                $TempItems->family = 'OTRO';
                $TempItems->iva = (float) ($request->iva ?? 0);
                $TempItems->ieps = (float) ($request->ieps ?? 0);
                $TempItems->isr = (float) ($request->isr ?? 0);
                $TempItems->retencion_iva = (float) ($request->retencion_iva ?? 0);
                $TempItems->retencion_isr = (float) ($request->retencion_isr ?? 0);
                $TempItems->other_retentions = (float) ($request->other_retentions ?? 0);
                $TempItems->retencion = (float) (($request->retencion_iva ?? 0) + ($request->retencion_isr ?? 0) + ($request->other_retentions ?? 0));
            }
            //$TempItems->subfamilia = $request->subfamily;
            $TempItems->categoria = $request->category;
            //$TempItems->products = $request->products;
            //$TempItems->code = $request->code;
           
            $TempItems->sku = $request->sku;
            
            $TempItems->description = $request->description;
            $TempItems->unit_price =(float) $request->unit_price;
            $TempItems->import = $Import;
            $TempItems->save();
        
        
        $TempInternalOrders = TempInternalOrder::where('id', $request->temp_internal_order_id)->first();
        $Customers = Customer::where('id', $TempInternalOrders->customer_id)->first();
        $TempItems = TempItem::where('temp_internal_order_id', $TempInternalOrders->id)->get();

        if(count($TempItems) > 0){
            $Subtotal = TempItem::where('temp_internal_order_id', $TempInternalOrders->id)->sum('import');
        }else{
            $Subtotal = '0';
        }

        $Iva = $Subtotal * 0.16;
        $Total = $Subtotal + $Iva;
        $cat=Session::get('cat');
        $desc=Session::get('desc');
        
        $obs=Session::get('obs');
        $title='ORDEN DE COMPRA INTERNA';
        if($TempInternalOrders->type=='requisition'){
             $title='REQUISICIÓN DE COMPRA';
        }
        return view('requisitions.capture_order_items', compact(
            'TempInternalOrders',
            'Customers',
            'TempItems',
            'Subtotal',
            'Iva',
            'Total',
            'cat','desc','obs','title'
        ));
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

    public function redefine(Request $request, $id,$captured)
    {        
        
        $cat=Session::get('cat');
        $desc=Session::get('desc');
        
        $obs=Session::get('obs');
        
        $rules = [
        'amount' => 'required',
        'unit' => 'required',
        'family' => 'required',
        
        
        'sku' => 'required',
        'description' => 'required',
        'unit_price' => 'required',
    ];

    $messages = [
        'amount.required' => 'La Cantidad es requerida',
        'unit.required' => 'La unidad es requerida',
        'family.required' => 'La familia es requerida',
        
        
        'sku.required' => 'SKU requerido',
        'description.required' => 'La descripción es requerida',
        'unit_price.required' => 'El precio unitario es requerido',
    ];

    $request->validate($rules, $messages);

    $Import = $request->amount * $request->unit_price;

    $TempItems = $Item = TempItem::find($id);

    $TempItems->temp_internal_order_id = $request->temp_internal_order_id;
    $TempItems->item = $request->item;
    $TempItems->amount = $request->amount;
    $TempItems->unit = $request->unit;
    $Producto = null;
    if($request->product && $request->product !== 'OTRO'){
        $Producto = Product::find($request->product);
    }
    if($Producto) {
        $TempItems->producto = $Producto->product;
        $TempItems->family = $Producto->family;
        $TempItems->iva = (float) ($Producto->iva ?? 0);
        $TempItems->ieps = (float) ($Producto->ieps ?? 0);
        $TempItems->isr = (float) ($Producto->isr ?? 0);
        $TempItems->retencion_iva = (float) ($Producto->retention_iva ?? 0);
        $TempItems->retencion_isr = (float) ($Producto->retention_isr ?? 0);
        $TempItems->other_retentions = (float) ($Producto->other_retentions ?? 0);
        $TempItems->retencion = (float) (($Producto->retention_iva ?? 0) + ($Producto->retention_isr ?? 0) + ($Producto->other_retentions ?? 0));
    } else {
        $TempItems->producto = $request->otro ?? null;
        $TempItems->family = 'OTRO';
        $TempItems->iva = (float) ($request->iva ?? 0);
        $TempItems->ieps = (float) ($request->ieps ?? 0);
        $TempItems->isr = (float) ($request->isr ?? 0);
        $TempItems->retencion_iva = (float) ($request->retencion_iva ?? 0);
        $TempItems->retencion_isr = (float) ($request->retencion_isr ?? 0);
        $TempItems->other_retentions = (float) ($request->other_retentions ?? 0);
        $TempItems->retencion = (float) (($request->retencion_iva ?? 0) + ($request->retencion_isr ?? 0) + ($request->other_retentions ?? 0));
    }
    //$TempItems->subfamilia = $request->subfamily;
    $TempItems->categoria = $request->category;
    //$TempItems->products = $request->products;
    //$TempItems->code = $request->code;
    
    $TempItems->sku = $request->sku;
    
    $TempItems->description = $request->description;
    $TempItems->unit_price =(float) $request->unit_price;
    $TempItems->import = $Import;
    $TempItems->save();
    
    
    $TempInternalOrders = TempInternalOrder::where('id', $request->temp_internal_order_id)->first();
    $Customers = Customer::where('id', $TempInternalOrders->customer_id)->first();
    $TempItems = TempItem::where('temp_internal_order_id', $TempInternalOrders->id)->get();

    if(count($TempItems) > 0){
        $Subtotal = TempItem::where('temp_internal_order_id', $TempInternalOrders->id)->sum('import');
    }else{
        $Subtotal = '0';
    }

    $Iva = $Subtotal * 0.16;
    $Total = $Subtotal + $Iva;
    
    if($captured==0){
    return view('requisitions.capture_order_items', compact(
        'TempInternalOrders',
        'Customers',
        'TempItems',
        'Subtotal',
        'Iva',
        'Total',
        'cat','desc','obs'
    ));
    }else{
        return view('requisitions.capture_order_items', compact(
        'TempInternalOrders',
        'Customers',
        'TempItems',
        'Subtotal',
        'Iva',
        'Total',
        'cat','desc','obs'
    ));
    }
    }
}
