<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;

class RoleController extends Controller
{
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
            $user = User::findOrfail($id);
            $roles = Role::all();

            return Inertia::render('RoleEditPage', [
                'user' => $user,
                'roles' => $roles,
                'updateUrl' => route('role.update', ['id' => $id]),
            ]);
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function update(Request $request, $id)
    {
        $roles = Role::all();
        $validateData = $request->validate([
            'nama_role' => 'required|string',
        ]);

        try {
            $roles->update($validateData);
            return redirect()->route('roles.edit', $roles)->with('success', 'Roles berhasil diaupdate');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan saat megupdate roles');
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
                'nama_role' => 'required|string',
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
