<?php

namespace App\Http\Controllers;

use App\Models\FormulirPelaksanaanTugas;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Validator;
use Inertia\Inertia;

class FormulirPelaksanaanTugasController extends Controller
{
    public function index()
    {
        $formulir = FormulirPelaksanaanTugas::all();
        return response()->json(['dataTugas' => $formulir]);
    }

    public function dataTugas()
    {
        try {
            // Ambil data formulir pelaksanaan tugas beserta relasinya
            $formulirPelaksanaanTugas = FormulirPelaksanaanTugas::with(['waktuUraianTugas', 'inventarisPos', 'shift', 'pos', 'sipam'])->get();

            return Inertia::render('DataTugasPage', [
                'formulirPelaksanaanTugas' => $formulirPelaksanaanTugas,
            ]);
        } catch (\Exception $e) {
            // Handle errors, for example, redirecting back with an error message
            return redirect()->back()->with('error', 'Terjadi kesalahan saat mengambil data formulir pelaksanaan tugas');
        }
    }

    public function editFormulirPelaksanaanTugas($id)
    {
        try {
            $formulir = FormulirPelaksanaanTugas::with(['waktuUraianTugas', 'inventarisPos', 'm_shift', 'm_pos', 'm_sipam'])->find($id);

            if (!$formulir) {
                return response()->json(['message' => 'Formulir not found'], 404);
            }

            return Inertia::render('TugasEditPage', [
                'success' => true,
                'message' => 'Formulir pelaksanaan tugas berhasil diambil',
                'data' => $formulir,
            ]);
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan saat mengambil data pelaksanaan tugas');
        }
    }

    public function updateFormulirPelaksanaanTugas(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'users_id' => ['required', 'integer', 'exists:users,id'],
            'tanggal_kejadian' => ['required', 'date'],
            'm_pos_id' => ['required', 'integer', 'exists:m_pos,id'],
            'm_sipam_id' => ['required', 'integer', 'exists:m_sipam,id'],
            'm_shift_id' => ['required', 'integer', 'exists:m_shift,id'],
            'waktu_uraian_tugas' => ['required', 'array'],
            'waktu_uraian_tugas.*.waktu' => ['required', 'date_format:H:i:s'],
            'waktu_uraian_tugas.*.uraian_tugas' => ['required', 'string'],
            'keterangan' => ['required', 'string'],
            'inventaris_pos' => [
                'required',
                'array',
                function ($attribute, $value, $fail) {
                    foreach ($value as $item) {
                        // Periksa setiap item dalam array
                        if (
                            !isset($item['m_barang_inventaris_id']) ||
                            !isset($item['jumlah']) ||
                            !isset($item['keterangan'])
                        ) {
                            // Jika ada item yang tidak lengkap, kirim pesan kesalahan
                            $fail("Setiap barang inventaris harus memiliki ID, jumlah, dan keterangan.");
                            return;
                        }
                    }
                },
            ],
            'inventaris_pos.*.m_barang_inventaris_id' => ['required', 'integer', 'exists:m_barang_inventaris,id'],
            'inventaris_pos.*.jumlah' => ['required', 'integer'],
            'inventaris_pos.*.keterangan' => ['required', 'string'],
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        try {
            $formulir = FormulirPelaksanaanTugas::with(['waktuUraianTugas', 'inventarisPos'])->find($id);

            if (!$formulir) {
                return response()->json(['message' => 'Formulir not found'], 404);
            }

            $formattedTanggalKejadian = Carbon::parse($request->tanggal_kejadian)->format('Y-m-d');

            $formulir->update([
                'users_id' => $request->users_id,
                'tanggal_kejadian' => $formattedTanggalKejadian,
                'm_pos_id' => $request->m_pos_id,
                'm_sipam_id' => $request->m_sipam_id,
                'm_shift_id' => $request->m_shift_id,
                'keterangan' => $request->keterangan,
            ]);

            // Update atau tambahkan waktuUraianTugas
            $formulir->waktuUraianTugas()->delete(); // Hapus yang lama
            $formulir->waktuUraianTugas()->createMany(
                array_map(function ($waktuUraianTugas) {
                    return [
                        'waktu' => Carbon::createFromFormat('H:i:s', $waktuUraianTugas['waktu']),
                        'uraian_tugas' => $waktuUraianTugas['uraian_tugas'],
                    ];
                }, $request->waktu_uraian_tugas)
            );

            // Update atau tambahkan inventarisPos
            $formulir->inventarisPos()->delete(); // Hapus yang lama
            $formulir->inventarisPos()->createMany($request->inventaris_pos);

            return response()->json([
                'success' => true,
                'message' => 'Formulir pelaksanaan tugas berhasil diperbarui',
                'data' => $formulir,
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan saat memperbarui formulir pelaksanaan tugas',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    public function storeFormulirPelaksanaanTugas(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'users_id' => ['required', 'integer', 'exists:users,id'],
            'tanggal_kejadian' => ['required', 'date'],
            'm_pos_id' => ['required', 'integer', 'exists:m_pos,id'],
            'm_sipam_id' => ['required', 'integer', 'exists:m_sipam,id'],
            'm_shift_id' => ['required', 'integer', 'exists:m_shift,id'],
            'waktu_uraian_tugas' => ['required', 'array'],
            'waktu_uraian_tugas.*.waktu' => ['required', 'date_format:H:i:s'],
            'waktu_uraian_tugas.*.uraian_tugas' => ['required', 'string'],
            'keterangan' => ['required', 'string'],
            'inventaris_pos' => [
                'required',
                'array',
                function ($attribute, $value, $fail) {
                    foreach ($value as $item) {
                        // Periksa setiap item dalam array
                        if (
                            !isset($item['m_barang_inventaris_id']) ||
                            !isset($item['jumlah']) ||
                            !isset($item['keterangan'])
                        ) {
                            // Jika ada item yang tidak lengkap, kirim pesan kesalahan
                            $fail("Setiap barang inventaris harus memiliki ID, jumlah, dan keterangan.");
                            return;
                        }
                    }
                },
            ],
            'inventaris_pos.*.m_barang_inventaris_id' => ['required', 'integer', 'exists:m_barang_inventaris,id'],
            'inventaris_pos.*.jumlah' => ['required', 'integer'],
            'inventaris_pos.*.keterangan' => ['required', 'string'],
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        try {
            $formattedTanggalKejadian = Carbon::parse($request->tanggal_kejadian)->format('Y-m-d');

            $formulir = FormulirPelaksanaanTugas::create([
                'users_id' => $request->users_id,
                'tanggal_kejadian' => $formattedTanggalKejadian,
                'm_pos_id' => $request->m_pos_id,
                'm_sipam_id' => $request->m_sipam_id,
                'm_shift_id' => $request->m_shift_id,
                'keterangan' => $request->keterangan,
            ]);

            $formulir->waktuUraianTugas()->createMany(
                array_map(function ($waktuUraianTugas) {
                    return [
                        'waktu' => Carbon::createFromFormat('H:i:s', $waktuUraianTugas['waktu']),
                        'uraian_tugas' => $waktuUraianTugas['uraian_tugas'],
                    ];
                }, $request->waktu_uraian_tugas)
            );

            foreach ($request->inventaris_pos as $inventarisPos) {
                $formulir->inventarisPos()->create([
                    'm_barang_inventaris_id' => $inventarisPos['m_barang_inventaris_id'],
                    'jumlah' => $inventarisPos['jumlah'],
                    'keterangan' => $inventarisPos['keterangan'],
                ]);
            }

            return response()->json([
                'success' => true,
                'message' => 'Formulir pelaksanaan tugas berhasil dibuat',
                'data' => $formulir,
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan saat membuat formulir pelaksanaan tugas',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    public function destroyForulirPelaksanaanTugas($id)
    {
        $formulir_patroli_laut = FormulirPelaksanaanTugas::findOrFail($id);
        $formulir_patroli_laut->delete();
        // return redirect()->route('dataPatroli');
    }



}
