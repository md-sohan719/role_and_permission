<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class RoleAndPermissionController extends Controller
{
    public function indexRole()
    {
        $roles = Role::orderBy('name', 'asc')->get();
        return view('backend.role_and_permission.roleIndex', compact('roles'));
    }

    public function storeRoleAjax(Request $request)
    {
        Role::create([
            'name' => $request->name
        ]);
        return response()->json(['success' => 'done']);
    }

    public function updateRoleAjax(Request $request)
    {
        Role::findOrFail($request->id)->update([
            'name' => $request->name
        ]);
        return response()->json(['success' => 'done']);
    }
}
