<?php

namespace App\Http\Controllers;

use App\Models\MShift;
use App\Models\PhotoPatroliLaut;
use App\Models\User;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\FormulirPatroliLaut;

class FormulirPatroliLautController extends Controller
{
    public function index()
    {
        $formulir = FormulirPatroliLaut::all();
        return response()->json(['dataPatroli' => $formulir]);
    }

    public function dataPatroli()
    {
        $formulir = FormulirPatroliLaut::with('photo_patroli_laut', 'm_shift')->get();
        return Inertia::render('DataTablePatroli', ['formulir_patroli_laut' => $formulir]);
    }

    public function show($id)
    {
        $formulir = FormulirPatroliLaut::with('photoPatroliLauts')->find($id);

        if (!$formulir) {
            return response()->json(['message' => 'Formulir not found'], 404);
        }

        return response()->json(['dataPatroli' => $formulir]);
    }


    public function edit($id)
    {
        try {
            $formulir = FormulirPatroliLaut::findOrFail($id);
            $m_shift = MShift::all();
            $photo = PhotoPatroliLaut::find($id);
            $user = User::find($formulir->users_id);

            return Inertia::render('UserEditPage', [
                'formulir_patroli_laut' => $formulir,
                'm_shift' => $m_shift,
                'photo' => $photo,
                'user' => $user,
                'updateUrl' => route('formulirpatrolilaut.update', ['id' => $id]),
            ]);
        } catch (\Exception $e) {
            // Handle errors, for example, redirecting back with an error message
            return redirect()->back()->with('error', 'Terjadi kesalahan saat mengambil data pengguna');
        }
    }

    public function update(Request $request, $id)
    {
        $formulir = FormulirPatroliLaut::findOrFail($id);
        $validatedData = $request->validate([
            'users_id' => 'required|exists:users,id',
            'tanggal_kejadian' => 'required|date',
            'm_shift_id' => 'required|exists:m_shift,id',
            'uraian_hasil' => 'required|string',
            'keterangan' => 'required|string',
        ]);

        try {
            // Mengupdate data user
            $formulir->update($validatedData);

            // Redirect back to the edit page with success message
            return redirect()->route('formulirpatrolilaut.edit', $formulir)->with('success', 'Formulir berhasil diupdate');
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
            $request = FormulirPatroliLaut::create([
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

    public function destroy($id)
    {
        $formulir_patroli_laut = FormulirPatroliLaut::findOrFail($id);
        $formulir_patroli_laut->delete();
        // return redirect()->route('dataPatroli');
    }
}