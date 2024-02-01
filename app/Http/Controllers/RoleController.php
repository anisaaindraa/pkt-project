<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;

class RoleController extends Controller
{
    public function index()
    {
        return Inertia::render("Dashboard");
    }

    public function dataRole()
    {
        $roles = Role::all();
        return Inertia::render("DataRolePage", ['roles' => $roles]);
    }

    public function create()
    {
        $storeUrl = route("roles.store");
        return inertia("RoleCreatePage", [
            'storeUrl' => $storeUrl,
        ]);
    }

    public function edit($id)
    {
        try {
            $role = Role::findOrFail($id);
            return Inertia::render('RoleEditPage', [
                'role' => $role,
                'updateUrl' => route('roles.update', ['id' => $id]),
            ]);
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function update(Request $request, $id)
    {
        $role = Role::find($id);
        $validateData = $request->validate([
            'nama_role' => 'required|string',
        ]);

        try {
            $role->update($validateData);
            return redirect()->route('roles.edit', ['id' => $id])->with('success', 'Role berhasil diupdate');
        } catch (\Exception $e) {
            return redirect()->route('dataroles')->with('error', 'Terjadi kesalahan saat mengupdate role');
        }
    }

    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'nama_role' => 'required|string',
        ]);

        try {
            $roles = Role::create([
                'nama_role' => $request->nama_role,
            ]);

            // Redirect atau berikan respons sukses
            return redirect()->route('dataroles')->with('success', 'Roles berhasil ditambahkan');
        } catch (\Exception $e) {
            // Tangani kesalahan
            return redirect()->route('create.roles')->with('error', 'Terjadi kesalahan saat menambahkan roles');
        }
    }

    public function destroy($id)
    {
        $roles = Role::findOrFail($id);
        $roles->delete();
        return redirect()->route('dataroles');
    }
}
