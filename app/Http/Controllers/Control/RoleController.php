<?php

namespace App\Http\Controllers\Control;

use App\Enums\Permission;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    public function addRole(Request $request)
    {
        $role = Role::create(['name' => $request->name]);
        return redirect()->back();
    }
    public function editPermissions(Role $role)
    {
        return view('control.roles.edit_permissions', [
            'role' => $role,
            'permissions' => Permission::cases(),
        ]);
    }

    public function addPermissions(Request $request, Role $role)
    {
        $role->givePermissionTo($request->permission);
        return redirect()->back();
    }
}
