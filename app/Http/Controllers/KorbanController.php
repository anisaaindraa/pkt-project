<?php

namespace App\Http\Controllers;

use App\Models\Korban;
use Illuminate\Http\Request;
use Inertia\Inertia;

class KorbanController extends Controller
{
    public function index()
    {
        $korban = Korban::all();
        return response()->json(['datakorban' => $korban]);
    }

    public function dataKorban()
    {
        $formulir_pelaporan_kejadian = Korban::all();
        return Inertia::render('DataTableKejadian', ['formulir_pelaporan_kejadian' => $formulir_pelaporan_kejadian]);
    }

    public function show($id)
    {
        $formulir = Korban::find($id);

        if (!$formulir) {
            return response()->json(['message' => 'Formulir not found'], 404);
        }

        return response()->json(['dataKorban' => $formulir]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'formulir_pelaporan_kejadian_id' => 'required|exists:users_id',
            'nama_korban' => 'required|string',
            'umur_korban' => 'required|integer',
            'pekerjaan_korban' => 'required|string',
            'alamat_korban' => 'required|string',
            'no_tlp_korban' => 'required|integer',
        ]);

        $formulirs = Korban::create($request->all());

        return response()->json(['data' => $formulirs], 201);
    }

    public function update(Request $request, $id)
    {
        $formulir = Korban::find($id);

        if (!$formulir) {
            return response()->json(['message' => 'Formulir not found'], 404);
        }

        $request->validate([
            'formulir_pelaporan_kejadian_id' => 'required|exists:users_id',
            'nama_korban' => 'required|string',
            'umur_korban' => 'required|integer',
            'pekerjaan_korban' => 'required|string',
            'alamat_korban' => 'required|string',
            'no_tlp_korban' => 'required|integer',
        ]);

        $formulir->update($request->all());

        return response()->json(['data' => $formulir]);
    }
}
