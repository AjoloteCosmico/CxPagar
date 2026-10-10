<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Coin;
use App\Models\Product;
use App\Models\Provider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;

class ProductController extends Controller
{
    public function index()
    {
        $Products = Product::all();
        return view('admin.products.index', compact('Products'));
    }

    public function create()
    {
        $Coins = Coin::orderBy('coin')->get();
        $Providers = Provider::orderBy('customer')->get();

        return view('admin.products.create', compact('Coins', 'Providers'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'sku' => ['required', 'string', 'max:255'],
            'tipo_bien' => ['required', 'string', 'max:100'],
            'product' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'family' => ['required', 'string', 'max:255'],
            'public_price' => ['required', 'numeric', 'gt:0'],
            'coin_id' => ['required', 'integer', 'exists:coins,id'],
            'provider_id' => ['required', 'integer', 'exists:customers,id'],
            'observations' => ['nullable', 'string'],
            'iva' => ['required', 'numeric', 'between:0,100'],
            'ieps' => ['nullable', 'numeric', 'between:0,100'],
            'isr' => ['nullable', 'numeric', 'between:0,100'],
            'retention_iva' => ['nullable', 'numeric', 'between:0,100'],
            'retention_isr' => ['nullable', 'numeric', 'between:0,100'],
            'other_retentions' => ['nullable', 'numeric', 'between:0,100']
        ], [
            'sku.required' => 'El SKU es obligatorio.',
            'tipo_bien.required' => 'El tipo de bien es obligatorio.',
            'product.required' => 'El producto o servicio es obligatorio.',
            'description.required' => 'La descripción es obligatoria.',
            'family.required' => 'La familia es obligatoria.',
            'public_price.required' => 'El precio público es obligatorio.',
            'public_price.gt' => 'El precio público debe ser mayor a 0.',
            'coin_id.required' => 'La moneda es obligatoria.',
            'coin_id.exists' => 'La moneda seleccionada no existe.',
            'provider_id.required' => 'El proveedor es obligatorio.',
            'provider_id.exists' => 'El proveedor seleccionado no existe.',
            'iva.required' => 'El IVA es obligatorio.',
            'iva.between' => 'El IVA debe estar entre 0 y 100.',
            'ieps.between' => 'IEPS debe estar entre 0 y 100.',
            'isr.between' => 'ISR debe estar entre 0 y 100.',
            'retention_iva.between' => 'Retención IVA debe estar entre 0 y 100.',
            'retention_isr.between' => 'Retención ISR debe estar entre 0 y 100.',
            'other_retentions.between' => 'Otras retenciones debe estar entre 0 y 100.'
        ]);

        $product = new Product();

        foreach (['sku', 'tipo_bien', 'product', 'family'] as $field) {
            if (Schema::hasColumn('products', $field)) {
                $product->{$field} = $data[$field] ?? null;
            }
        }

        if (Schema::hasColumn('products', 'description')) {
            $product->description = $data['description'];
        }
        if (Schema::hasColumn('products', 'public_price')) {
            $product->public_price = $data['public_price'];
        }
        if (Schema::hasColumn('products', 'coin_id')) {
            $product->coin_id = $data['coin_id'];
        }
        if (Schema::hasColumn('products', 'provider_id')) {
            $product->provider_id = $data['provider_id'];
        }
        if (Schema::hasColumn('products', 'observations')) {
            $product->observations = $data['observations'] ?? null;
        }
        if (Schema::hasColumn('products', 'iva')) {
            $product->iva = $data['iva'];
        }
        if (Schema::hasColumn('products', 'ieps')) {
            $product->ieps = $data['ieps'] ?? 0;
        }
        if (Schema::hasColumn('products', 'isr')) {
            $product->isr = $data['isr'] ?? 0;
        }
        if (Schema::hasColumn('products', 'retention_iva')) {
            $product->retention_iva = $data['retention_iva'] ?? 0;
        }
        if (Schema::hasColumn('products', 'retention_isr')) {
            $product->retention_isr = $data['retention_isr'] ?? 0;
        }
        if (Schema::hasColumn('products', 'other_retentions')) {
            $product->other_retentions = $data['other_retentions'] ?? 0;
        }

        $product->save();

        return redirect()->route('products.index')->with('success', 'Producto creado correctamente.');
    }

    public function edit($id)
    {
        $Product = Product::findOrFail($id);
        $Coins = Coin::orderBy('coin')->get();
        $Providers = Provider::orderBy('customer')->get();

        return view('admin.products.show', compact('Product', 'Coins', 'Providers'));
    }

    public function update(Request $request, $id)
    {
        $Product = Product::findOrFail($id);

        $data = $request->validate([
            'sku' => ['required', 'string', 'max:255'],
            'tipo_bien' => ['required', 'string', 'max:100'],
            'product' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'family' => ['required', 'string', 'max:255'],
            'public_price' => ['required', 'numeric', 'gt:0'],
            'coin_id' => ['required', 'integer', 'exists:coins,id'],
            'provider_id' => ['required', 'integer', 'exists:customers,id'],
            'observations' => ['nullable', 'string'],
            'iva' => ['required', 'numeric', 'between:0,100'],
            'ieps' => ['nullable', 'numeric', 'between:0,100'],
            'isr' => ['nullable', 'numeric', 'between:0,100'],
            'retention_iva' => ['nullable', 'numeric', 'between:0,100'],
            'retention_isr' => ['nullable', 'numeric', 'between:0,100'],
            'other_retentions' => ['nullable', 'numeric', 'between:0,100']
        ], [
            'sku.required' => 'El SKU es obligatorio.',
            'tipo_bien.required' => 'El tipo de bien es obligatorio.',
            'product.required' => 'El producto o servicio es obligatorio.',
            'description.required' => 'La descripción es obligatoria.',
            'family.required' => 'La familia es obligatoria.',
            'public_price.required' => 'El precio público es obligatorio.',
            'public_price.gt' => 'El precio público debe ser mayor a 0.',
            'coin_id.required' => 'La moneda es obligatoria.',
            'coin_id.exists' => 'La moneda seleccionada no existe.',
            'provider_id.required' => 'El proveedor es obligatorio.',
            'provider_id.exists' => 'El proveedor seleccionado no existe.',
            'iva.required' => 'El IVA es obligatorio.',
            'iva.between' => 'El IVA debe estar entre 0 y 100.',
            'ieps.between' => 'IEPS debe estar entre 0 y 100.',
            'isr.between' => 'ISR debe estar entre 0 y 100.',
            'retention_iva.between' => 'Retención IVA debe estar entre 0 y 100.',
            'retention_isr.between' => 'Retención ISR debe estar entre 0 y 100.',
            'other_retentions.between' => 'Otras retenciones debe estar entre 0 y 100.'
        ]);

        foreach (['sku', 'tipo_bien', 'product', 'family' ] as $field) {
            if (Schema::hasColumn('products', $field)) {
                $Product->{$field} = $data[$field] ?? null;
            }
        }

        if (Schema::hasColumn('products', 'description')) {
            $Product->description = $data['description'];
        }
        if (Schema::hasColumn('products', 'public_price')) {
            $Product->public_price = $data['public_price'];
        }
        if (Schema::hasColumn('products', 'coin_id')) {
            $Product->coin_id = $data['coin_id'];
        }
        if (Schema::hasColumn('products', 'provider_id')) {
            $Product->provider_id = $data['provider_id'];
        }
        if (Schema::hasColumn('products', 'observations')) {
            $Product->observations = $data['observations'] ?? null;
        }
        if (Schema::hasColumn('products', 'iva')) {
            $Product->iva = $data['iva'];
        }
        if (Schema::hasColumn('products', 'ieps')) {
            $Product->ieps = $data['ieps'] ?? 0;
        }
        if (Schema::hasColumn('products', 'isr')) {
            $Product->isr = $data['isr'] ?? 0;
        }
        if (Schema::hasColumn('products', 'retention_iva')) {
            $Product->retention_iva = $data['retention_iva'] ?? 0;
        }
        if (Schema::hasColumn('products', 'retention_isr')) {
            $Product->retention_isr = $data['retention_isr'] ?? 0;
        }
        if (Schema::hasColumn('products', 'other_retentions')) {
            $Product->other_retentions = $data['other_retentions'] ?? 0;
        }

        $Product->save();

        return redirect()->route('products.index')->with('success', 'Producto actualizado correctamente.');
    }
}
