<?php

namespace App\Http\Controllers;

use App\Models\FormulirPelaporanKejadian;
use App\Models\Pelaku;
use App\Models\Korban;
use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;

class FormulirPelaporanKejadianController extends Controller
{
    public function index()
    {
        $formulirs = FormulirPelaporanKejadian::all();
        return Inertia::render('DataKejadian', ['formulir_pelaporan_kejadian' => $formulirs]);
    }

    public function datakejadian()
    {
        $formulir_pelaporan_kejadian = FormulirPelaporanKejadian::with('pelaku', 'korban')->get();
        return Inertia::render('DataKejadian', ['formulir_pelaporan_kejadian' => $formulir_pelaporan_kejadian]);
    }

    public function show($id)
    {
        $formulir = FormulirPelaporanKejadian::find($id);

        if (!$formulir)
        {
            return response()->json(['message' => 'Formulir not found'], 404);
        }

        return response()->json(['dataKejadian' => $formulir]);
    }

    public function edit($id)
    {
        try
        {
            $formulir = FormulirPelaporanKejadian::find($id);
            $korban = Korban::where('formulir_pelaporan_kejadian_id', $id)->get();
            $pelaku = Pelaku::where('formulir_pelaporan_kejadian_id', $id)->get();
            $user = User::find($formulir->users_id);

            return Inertia::render('KejadianEditPage', [
                'formulir' => $formulir,
                'pelaku' => $pelaku,
                'korban' => $korban,
                'user' => $user,
                'updateUrl' => route('formulirpelaporankejadian.update', ['id' => $id]),
            ]);
        }
        catch (\Exception $e)
        {
            // Handle errors, for example, redirecting back with an error message
            return redirect()->back()->with('error', 'Terjadi kesalahan saat mengambil data formulir');
        }
    }

    public function update(Request $request, $id)
    {
        $formulir = FormulirPelaporanKejadian::with(['korban', 'pelaku'])->find($id);

        if (!$formulir)
        {
            return response()->json(['message' => 'Formulir not found'], 404);
        }

        $request->validate([
            'users_id' => 'required|exists:users,id',
            'jenis_kejadian' => 'required|string',
            'tanggal_kejadian' => 'required',
            'tempat_kejadian' => 'required|string',
            'kerugian_akibat_kejadian' => 'required|string',
            'keterangan_lain' => 'required|string',
        ]);

        // Update the main model
        $formulir->update($request->all());

        // Assuming 'korban' and 'pelaku' are relationships on the 'FormulirPelaporanKejadian' model
        if ($request->has('korban'))
        {
            $formulir->korban()->update($request->input('korban'));
        }

        if ($request->has('pelaku'))
        {
            $formulir->pelaku()->update($request->input('pelaku'));
        }

        return Inertia::location(route('formulirpelaporankejadian.edit', ['id' => $formulir->id]));


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

        // Simpan formulir pelaporan kejadian
        $formulir = FormulirPelaporanKejadian::create($request->all());

        // Simpan korban
        $formulir->korban()->createMany($request->korban);

        // Simpan pelaku
        $formulir->pelaku()->createMany($request->pelaku);

        return response()->json(['data' => $formulir], 201);
    }

    public function destroy($id)
    {
        $formulir_patroli_laut = FormulirPelaporanKejadian::findOrFail($id);
        $formulir_patroli_laut->delete();
        // return redirect()->route('dataPatroli');
    }
}
