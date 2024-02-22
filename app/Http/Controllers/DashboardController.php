<?php

namespace App\Http\Controllers;

use App\Models\FormulirPatroliLaut;
use App\Models\User;
use App\Models\MShift;
use App\Models\PhotoPatroliLaut;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class DashboardController extends Controller
{
    public function index()
    {
        return Inertia::render('Dashboard');
    }

    public function dataPatroli()
    { 
        
        $formulir_patroli_laut = FormulirPatroliLaut::join('users', 'formulir_patroli_laut.users_id', '=', 'users.id')
            ->join('m_shift', 'formulir_patroli_laut.m_shift_id', '=', 'm_shift.id')
            ->select('formulir_patroli_laut.*', 'users.*', 'm_shift.*', 
            'formulir_patroli_laut.keterangan as keterangan_formulir_patroli_laut', 
            'm_shift.keterangan as keterangan_m_shift',
            'formulir_patroli_laut.id as id_formulir_patroli_laut',
            'm_shift.id as id_m_shift',
            )
            ->get();
        
        return Inertia::render('DataPatroli', ['formulir_patroli_laut' => $formulir_patroli_laut]);
    }

    public function dataTable()
    {
        $users = User::all();
        return Inertia::render('DataTablePage', ['users' => $users]);
    }

    public function createUserPage()
    {
        $roles = Role::all();
        return Inertia::render('UserCreatePage', ['roles' => $roles]);
    }

    public function storeAndShowDataTable(Request $request)
    {
        $request->validate([
            'role_id' => 'required|exists:roles,id',
            'username' => 'required|max:20',
            'email' => ['required', 'email', Rule::unique('users')],
            'password' => 'required|min:6',
            'nama_user' => 'required|max:100',
            'alamat_user' => 'required',
            'pekerjaan_user' => 'required',
            'npk_user' => 'required',
        ]);

        try {
            // Menambahkan data user baru ke dalam database
            $user = User::create([
                'role_id' => $request->role_id,
                'username' => $request->username,
                'email' => $request->email,
                'password' => bcrypt($request->password),
                'nama_user' => $request->nama_user,
                'alamat_user' => $request->alamat_user,
                'pekerjaan_user' => $request->pekerjaan_user,
                'npk_user' => $request->npk_user,
                'created_by' => Auth::user()->id,
            ]);

            // Mendapatkan data user terbaru setelah penyimpanan
            $users = User::all();

            // Menampilkan halaman DataTablePage dengan data terbaru
            return Inertia::render('DataTablePage', ['users' => $users]);
        } catch (\Exception $e) {
            dd($e->getMessage());
        }
    }
}
