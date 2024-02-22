<?php

namespace App\Http\Controllers;

use App\Models\FormulirPatroliLaut;
use App\Models\FormulirPelaksanaanTugas;
use App\Models\FormulirPelaporanKejadian;
use App\Models\MShift;
use App\Models\PhotoPatroliLaut;
use Firebase\JWT\JWT;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Validator;
use Firebase\JWT\Key;

class APIController extends Controller
{
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => ['required', 'email'],
            'password' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $credentials = $request->only('email', 'password');

        //if auth failed
        if (!$token = auth()->guard('api')->attempt($credentials)) {
            return response()->json([
                'success' => false,
                'message' => 'Email atau Password Anda salah'
            ], 401);
        }

        $payload = [
            'iss' => auth()->guard('api')->user(),
            'exp' => time() + 3600
        ];

        $jwt = JWT::encode($payload, config("app.jwt_token"), 'HS256');

        //if auth success
        return response()->json([
            'success' => true,
            'user' => auth()->guard('api')->user(),
            'token' => $jwt
        ], 200);
    }

    public function getUserId(Request $request)
    {
        $token = $request->header('Authorization');
        $decoded = JWT::decode($token, new Key(config('app.jwt_token'), 'HS256'));

        return response()->json(['user_id' => $decoded->iss->id]);
    }

    public function createFormulirPatroliLaut(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'users_id' => ['required', 'integer', 'exists:users,id'],
            'tanggal_kejadian' => ['required', 'date'],
            'm_shift_id' => ['required', 'integer', 'exists:m_shift,id'],
            'uraian_hasil' => ['required', 'string'],
            'keterangan' => ['required', 'string'],
            'photo_patroli_laut.*.photo_path' => ['required', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048'],
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        try {
            // Simpan data formulir ke dalam database
            $formulir = FormulirPatroliLaut::create([
                'users_id' => $request->users_id,
                'tanggal_kejadian' => $request->tanggal_kejadian,
                'm_shift_id' => $request->m_shift_id,
                'uraian_hasil' => $request->uraian_hasil,
                'keterangan' => $request->keterangan,
            ]);

            // Use createMany directly on PhotoPatroliLaut
            $formulir->photoPatroliLaut()->createMany($request->photo_patroli_laut);

            return response()->json([
                'success' => true,
                'message' => 'Formulir patroli laut berhasil dibuat',
                'data' => $formulir,
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan saat membuat formulir patroli laut',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    // Fungsi untuk membuat formulir pelaporan kejadian
    public function createFormulirPelaporanKejadian(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'users_id' => ['required', 'integer', 'exists:users,id'],
            'jenis_kejadian' => ['required', 'string'],
            'tanggal_kejadian' => ['required'],
            'tempat_kejadian' => ['required', 'string'],
            'kerugian_akibat_kejadian' => ['nullable', 'string'],
            'keterangan_lain' => ['required', 'string'],
            'korban' => ['required', 'array'],
            'korban.*.nama_korban' => ['required', 'string'],
            'korban.*.umur_korban' => ['required', 'integer'],
            'korban.*.pekerjaan_korban' => ['required', 'string'],
            'korban.*.alamat_korban' => ['required', 'string'],
            'korban.*.no_tlp_korban' => ['required', 'integer'],
            'pelaku' => ['required', 'array'],
            'pelaku.*.nama_pelaku' => ['required', 'string'],
            'pelaku.*.umur_pelaku' => ['required', 'integer'],
            'pelaku.*.pekerjaan_pelaku' => ['required', 'string'],
            'pelaku.*.alamat_pelaku' => ['required', 'string'],
            'pelaku.*.no_tlp_pelaku' => ['required', 'integer'],
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        try {
            // Format the 'waktu_kejadian' using Carbon
            $formattedWaktuKejadian = Carbon::createFromFormat('H:i', $request->waktu_kejadian)->format('Y-m-d H:i:s');

            // Simpan data formulir pelaporan kejadian ke dalam database
            $formulir = FormulirPelaporanKejadian::create([
                'users_id' => $request->users_id,
                'jenis_kejadian' => $request->jenis_kejadian,
                'tanggal_waktu_kejadian' => $request->tanggal_kejadian,
                'tempat_kejadian' => $request->tempat_kejadian,
                'kerugian_akibat_kejadian' => $request->kerugian_akibat_kejadian,
                'keterangan_lain' => $request->keterangan_lain,
            ]);

            // Simpan korban
            $formulir->korban()->createMany($request->korban);

            // Simpan pelaku
            $formulir->pelaku()->createMany($request->pelaku);

            return response()->json([
                'success' => true,
                'message' => 'Formulir pelaporan kejadian berhasil dibuat',
                'data' => $formulir,
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan saat membuat formulir pelaporan kejadian',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    public function createFormulirPelaksanaanTugas(Request $request)
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
            // Format the 'tanggal_kejadian' using Carbon
            $formattedTanggalKejadian = Carbon::parse($request->tanggal_kejadian)->format('Y-m-d');

            // Simpan data formulir pelaksanaan tugas ke dalam database
            $formulir = FormulirPelaksanaanTugas::create([
                'users_id' => $request->users_id,
                'tanggal_kejadian' => $formattedTanggalKejadian,
                'm_pos_id' => $request->m_pos_id,
                'm_sipam_id' => $request->m_sipam_id,
                'm_shift_id' => $request->m_shift_id,
                'keterangan' => $request->keterangan,
            ]);

            // simpan waktu dan uraian tugas
            $formulir->waktuUraianTugas()->createMany(
                array_map(function ($waktuUraianTugas) {
                    return [
                        'waktu' => Carbon::createFromFormat('H:i:s', $waktuUraianTugas['waktu']),
                        'uraian_tugas' => $waktuUraianTugas['uraian_tugas'],
                    ];
                }, $request->waktu_uraian_tugas)
            );

            // Simpan inventaris POS
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
}
