<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RolePermission;
use App\Models\Role;
use App\Models\Permission;

class RolePermissionController extends Controller
{
    // Mengambil data roles dan permissions
    public function getRolesAndPermissions()
    {
        try {
            $roles = Role::all();
            $permissions = Permission::all();

            return response()->json(['roles' => $roles, 'permissions' => $permissions]);
        } catch (\Exception $e) {
            \Log::error('Error: ' . $e->getMessage());
            return response()->json(['error' => 'Internal Server Error'], 500);
        }
    }

    // Menyimpan perubahan izin
    public function saveRolePermissions(Request $request)
    {
        $data = $request->validate([
            'roleId' => 'required|integer',
            'selectedPermissions' => 'required|array',
            'selectedPermissions.*' => 'integer',
        ]);

        try {
            // Hapus izin lama
            RolePermission::where('role_id', $data['roleId'])->delete();

            // Tambahkan izin baru
            $newPermissions = [];
            foreach ($data['selectedPermissions'] as $permissionId) {
                $newPermissions[] = [
                    'role_id' => $data['roleId'],
                    'permissions_id' => $permissionId,
                ];
            }
            RolePermission::insert($newPermissions);

            return response()->json(['message' => 'Perubahan izin berhasil disimpan']);
        } catch (\Exception $e) {
            \Log::error('Error: ' . $e->getMessage());
            return response()->json(['error' => 'Internal Server Error'], 500);
        }
    }
}
