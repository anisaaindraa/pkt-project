<?php

namespace App\Http\Controllers;

use App\Models\FormulirPelaporanKejadian;
use Illuminate\Http\Request;
use Inertia\Inertia;

class FormulirPelaporanKejadianController extends Controller
{
    public function index()
    {
        $formulirs = FormulirPelaporanKejadian::all();
        return response()->json(['dataKejadian' => $formulirs]);
    }

    public function datakejadian()
    {
        $formulir_pelaporan_kejadian = FormulirPelaporanKejadian::all();
        return Inertia::render('DataTableKejadian', ['formulir_pelaporan_kejadian' => $formulir_pelaporan_kejadian]);
    }

    public function show($id)
    {
        $formulir = FormulirPelaporanKejadian::find($id);

        if (!$formulir) {
            return response()->json(['message' => 'Formulir not found'], 404);
        }

        return response()->json(['dataKejadian' => $formulir]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'users_id' => 'required|exists:users,id',
            'jenis_kejadian' => 'required|string',
            'tanggal_kejadian' => 'required|date',
            'waktu_keajadian' => 'required|time',
            'tempat_kejadian' => 'required|string',
            'kerugian_akibat_kejadian' => 'required|string',
            'keterangan_lain' => 'required|string',
        ]);

        $formulir = FormulirPelaporanKejadian::create($request->all());

        return response()->json(['data' => $formulir], 201);
    }

    public function update(Request $request, $id)
    {
        $formulir = FormulirPelaporanKejadian::find($id);

        if (!$formulir) {
            return response()->json(['message' => 'Formulir not found'], 404);
        }

        $request->validate([
            'users_id' => 'required|exists:users,id',
            'jenis_kejadian' => 'required|string',
            'tanggal_kejadian' => 'required|date',
            'waktu_keajadian' => 'required|time',
            'tempat_kejadian' => 'required|string',
            'kerugian_akibat_kejadian' => 'required|string',
            'keterangan_lain' => 'required|string',
        ]);

        $formulir->update($request->all());

        return response()->json(['data' => $formulir]);
    }

    public function destroy($id)
    {
        $formulir = FormulirPelaporanKejadian::find($id);

        if (!$formulir) {
            return response()->json(['message' => 'Formulir not found'], 404);
        }

        $formulir->delete();

        return response()->json(['message' => 'Formulir deleted']);
    }
}
