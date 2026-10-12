<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Coin;
use App\Models\GastosFijos;
use Illuminate\Http\Request;

class GastosFijosController extends Controller
{
    public function index()
    {
        $gastosFijos = GastosFijos::with('coin')->get();

        return view('admin.gastos_fijos.index', compact('gastosFijos'));
    }

    public function create()
    {
        $Coins = Coin::orderBy('coin')->get();

        return view('admin.gastos_fijos.create', compact('Coins'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'description' => ['required', 'string', 'max:100'],
            'amount' => ['required', 'numeric', 'gt:0'],
            'coin_id' => ['required', 'integer', 'exists:coins,id'],
            'periodicity' => ['required', 'string', 'in:SEMANAL,MENSUAL,BIMESTRAL,SEMESTRAL,ANUAL'],
        ], [
            'description.required' => 'La descripción es obligatoria.',
            'description.max' => 'La descripción no puede exceder 100 caracteres.',
            'amount.required' => 'El monto es obligatorio.',
            'amount.numeric' => 'El monto debe ser numérico.',
            'amount.gt' => 'El monto debe ser mayor a 0.',
            'coin_id.required' => 'La moneda es obligatoria.',
            'coin_id.exists' => 'La moneda seleccionada no existe.',
            'periodicity.required' => 'La periodicidad es obligatoria.',
            'periodicity.in' => 'La periodicidad debe ser una de: SEMANAL, MENSUAL, BIMESTRAL, SEMESTRAL o ANUAL.',
        ]);

        $gasto = new GastosFijos();
        $gasto->description = $data['description'];
        $gasto->amount = $data['amount'];
        $gasto->coin_id = $data['coin_id'];
        $gasto->periodicity = $data['periodicity'];
        $gasto->save();

        return redirect()->route('gastos_fijos.index')->with('success', 'Gasto fijo creado correctamente.');
    }

    public function show($id)
    {
        $gasto = GastosFijos::with('coin')->findOrFail($id);
        $Coins = Coin::orderBy('coin')->get();

        return view('admin.gastos_fijos.show', compact('gasto', 'Coins'));
    }

    public function edit($id)
    {
        return $this->show($id);
    }

    public function update(Request $request, $id)
    {
        $gasto = GastosFijos::findOrFail($id);

        $data = $request->validate([
            'description' => ['required', 'string', 'max:100'],
            'amount' => ['required', 'numeric', 'gt:0'],
            'coin_id' => ['required', 'integer', 'exists:coins,id'],
            'periodicity' => ['required', 'string', 'in:SEMANAL,MENSUAL,BIMESTRAL,SEMESTRAL,ANUAL'],
        ], [
            'description.required' => 'La descripción es obligatoria.',
            'description.max' => 'La descripción no puede exceder 100 caracteres.',
            'amount.required' => 'El monto es obligatorio.',
            'amount.numeric' => 'El monto debe ser numérico.',
            'amount.gt' => 'El monto debe ser mayor a 0.',
            'coin_id.required' => 'La moneda es obligatoria.',
            'coin_id.exists' => 'La moneda seleccionada no existe.',
            'periodicity.required' => 'La periodicidad es obligatoria.',
            'periodicity.in' => 'La periodicidad debe ser una de: SEMANAL, MENSUAL, BIMESTRAL, SEMESTRAL o ANUAL.',
        ]);

        $gasto->description = $data['description'];
        $gasto->amount = $data['amount'];
        $gasto->coin_id = $data['coin_id'];
        $gasto->periodicity = $data['periodicity'];
        $gasto->save();

        return redirect()->route('gastos_fijos.index')->with('success', 'Gasto fijo actualizado correctamente.');
    }

    public function destroy($id)
    {
        $gasto = GastosFijos::findOrFail($id);
        $gasto->delete();

        return redirect()->route('gastos_fijos.index')->with('success', 'Gasto fijo eliminado correctamente.');
    }
}
