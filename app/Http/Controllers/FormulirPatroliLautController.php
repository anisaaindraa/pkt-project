<?php

namespace App\Http\Controllers;

use App\Models\MShift;
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

    public function create()
    {
        // Mendapatkan daftar role untuk form
        $shift = MShift::all();
        $storeUrl = route('formulirpatrolilaut.store');

        return inertia('PatroliCreatePage', [
            'shift' => $shift,
            'storeUrl' => $storeUrl
        ]);
    }

    public function edit($id)
    {
        try {
            $formulir_patroli_laut = FormulirPatroliLaut::findOrFail($id);
            $shift = MShift::all();

            return Inertia::render('UserEditPage', [
                'formulir_patroli_laut' => $formulir_patroli_laut,
                'shift' => $shift,
                'updateUrl' => route('formulirpatrolilaut.update', ['id' => $id]),
            ]);
        } catch (\Exception $e) {
            // Handle errors, for example, redirecting back with an error message
            return redirect()->back()->with('error', 'Terjadi kesalahan saat mengambil data pengguna');
        }
    }

    public function update(Request $request, $id)
    {
        $formulir_patroli_laut = FormulirPatroliLaut::findOrFail($id);
        $validatedData = $request->validate([
            'users_id' => 'exists:users,id',
            'tanggal_kejadian' => 'date',
            'm_shift_id' => 'exists:m_shift,id',
            'uraian_hasil' => 'string',
            'keterangan' => 'string',
        ]);

        try {
            // Mengupdate data user
            $formulir_patroli_laut->update($validatedData);

            // Redirect back to the edit page with success message
            return redirect()->route('formulirpatrolilaut.edit', $formulir_patroli_laut)->with('success', 'Formulir berhasil diupdate');
        } catch (\Exception $e) {
            // Handle errors
            return redirect()->back()->with('error', 'Terjadi kesalahan saat mengupdate Formulir');
        }
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

        try {
            // Menambahkan data user baru ke dalam database
            $user = FormulirPatroliLaut::create([
                'users_id' => $request->users_id,
                'tanggal_kejadian' => $request->tanggal_kejadian,
                'm_shift_id' => $request->m_shift_id,
                'uraian_hasil' => $request->uraian_hasil,
                'keterangan' => $request->keterangan,
            ]);

            // Redirect atau berikan respons sukses
            return redirect()->route('dataPatroli')->with('success', 'Formulir berhasil ditambahkan');
        } catch (\Exception $e) {
            // Tangani kesalahan
            return redirect()->route('formulirpatrolilaut.create')->with('error', 'Terjadi kesalahan saat menambahkan formulir');
        }
    }

    public function show($id)
    {
        $formulir_patroli_laut = FormulirPatroliLaut::with('photoPatroliLauts')->find($id);

        if (!$formulir_patroli_laut) {
            return response()->json(['message' => 'Formulir not found'], 404);
        }

        return response()->json(['dataPatroli' => $formulir_patroli_laut]);
    }

    public function destroy($id)
    {
        $formulir_patroli_laut = FormulirPatroliLautController::findOrFail($id);
        $formulir_patroli_laut->delete();
        return redirect()->route('dataPatroli');
    }
}