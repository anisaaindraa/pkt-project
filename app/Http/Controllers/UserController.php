<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Inertia\Inertia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    public function index()
    {
        return Inertia::render('Dashboard');
    }

    public function dataTable()
    {
        $users = User::all();
        return Inertia::render('DataTablePage', ['users' => $users]);
    }

    public function create()
    {
        // Mendapatkan daftar role untuk form
        $roles = Role::all();
        $storeUrl = route('users.store');

        return inertia('UserCreatePage', [
            'roles' => $roles,
            'storeUrl' => $storeUrl
        ]);
    }

    public function edit($id)
    {
        try {
            $user = User::findOrFail($id);
            $roles = Role::all();

            return Inertia::render('UserEditPage', [
                'user' => $user,
                'roles' => $roles,
                'updateUrl' => route('users.update', ['id' => $id]),
            ]);
        } catch (\Exception $e) {
            // Handle errors, for example, redirecting back with an error message
            return redirect()->back()->with('error', 'Terjadi kesalahan saat mengambil data pengguna');
        }
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $validatedData = $request->validate([
            'role_id' => 'required|exists:roles,id',
            'username' => 'required|max:20',
            'email' => ['required', 'email', Rule::unique('users')->ignore($id)],
            'password' => 'nullable|min:6',
            'nama_user' => 'required|max:100',
            'alamat_user' => 'required',
            'pekerjaan_user' => 'required',
            'npk_user' => 'required',
        ]);

        try {
            // Mengupdate data user
            $user->update($validatedData);

            // Redirect back to the edit page with success message
            return redirect()->route('users.edit', $user)->with('success', 'User berhasil diupdate');
        } catch (\Exception $e) {
            // Handle errors
            return redirect()->back()->with('error', 'Terjadi kesalahan saat mengupdate user');
        }
    }

    public function store(Request $request)
    {
        // Validasi input
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
            ]);

            // Redirect atau berikan respons sukses
            return redirect()->route('datatable')->with('success', 'User berhasil ditambahkan');
        } catch (\Exception $e) {
            // Tangani kesalahan
            return redirect()->route('create.users.page')->with('error', 'Terjadi kesalahan saat menambahkan user');
        }
    }


    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return redirect()->route('datatable');
    }
}
