<?php

namespace App\Http\Controllers\Security;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolePermission extends Controller
{
    public function index(Request $request)
    {
        $roles = Role::get();
        $permissions = Permission::get();
        return view('admin.role-permission.permissions', compact('roles', 'permissions'));
    }

    public function store(Request $request)
    {
        foreach($request->permission as $key=>$value){
            $permission=Permission::findById($key);
            $permission->syncRoles($value);
        }

      return redirect()->back()->with('success','updated successfully');
    }
}
