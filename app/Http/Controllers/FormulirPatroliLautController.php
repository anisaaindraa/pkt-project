<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\FormulirPatroliLaut;

class FormulirPatroliLautController extends Controller
{
    public function index()
    {
        $formulirs = FormulirPatroliLaut::all();
        return response()->json(['dataPatroli' => $formulirs]);
    }

    public function dataPatroli()
    {
        $formulir_patroli_laut = FormulirPatroliLaut::all();
        return Inertia::render('DataTablePatroli', ['formulir_patroli_laut' => $formulir_patroli_laut]);
    }

    public function show($id)
    {
        $formulir = FormulirPatroliLaut::find($id);

        if (!$formulir) {
            return response()->json(['message' => 'Formulir not found'], 404);
        }

        return response()->json(['dataPatroli' => $formulir]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'users_id' => 'required|exists:users,id',
            'tanggal_kejadian' => 'required|date',
            'm_shift_id' => 'required|exists:m_shift,id',
            'uraian_hasil' => 'required|string',
            'keterangan' => 'required|string',

        ]);

        $formulir = FormulirPatroliLaut::create($request->all());

        return response()->json(['data' => $formulir], 201);
    }

    public function update(Request $request, $id)
    {
        $formulir = FormulirPatroliLaut::find($id);

        if (!$formulir) {
            return response()->json(['message' => 'Formulir not found'], 404);
        }

        $request->validate([
            'users_id' => 'exists:users,id',
            'tanggal_kejadian' => 'date',
            'm_shift_id' => 'exists:m_shift,id',
            'uraian_hasil' => 'string',
            'keterangan' => 'string',
        ]);

        $formulir->update($request->all());

        return response()->json(['data' => $formulir]);
    }

    public function destroy($id)
    {
        $formulir = FormulirPatroliLaut::find($id);

        if (!$formulir) {
            return response()->json(['message' => 'Formulir not found'], 404);
        }

        $formulir->delete();

        return response()->json(['message' => 'Formulir deleted']);
    }
}