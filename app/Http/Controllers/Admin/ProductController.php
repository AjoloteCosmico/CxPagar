<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    public function index(){
        $Products=Product::all();
        return view('admin.products.index',compact('Products'));
    }

    public function create(){
        return view('admin.products.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'product' => 'required|string|max:255',
            'sku' => 'required|string|max:255',
            'family' => 'required|string|max:255',
            'tax' => 'required|numeric',
        ]);

        $product = new Product();
        $product->product = $data['product'];
        $product->sku = $data['sku'];
        $product->family = $data['family'];
        $product->tax = $data['tax'];
        $product->save();

        return redirect()->route('products.index')->with('success', 'Producto creado correctamente.');
    }


    public function edit($id){
        $Product=Product::find($id);
        return view('admin.products.show',compact('Product'));
    }

    public function update(Request $request, $id)
    {
        $Product = Product::findOrFail($id);

        $data = $request->validate([
            'product' => 'required|string|max:255',
            'sku' => 'required|string|max:255',
            'family' => 'required|string|max:255',
            'tax' => 'required|numeric',
        ]);

        $Product->product = $data['product'];
        $Product->sku = $data['sku'];
        $Product->family = $data['family'];
        $Product->tax = $data['tax'];
        $Product->save();

        return redirect()->route('products.index')->with('success', 'Producto actualizado correctamente.');
    }
}
