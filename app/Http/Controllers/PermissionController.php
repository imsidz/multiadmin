<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{
    public function roleindex(){
    	$roles = Role::paginate(20);
        $permissions = Permission::get();
    	return view('admin.role.index', compact('roles', 'permissions'));
    }

    public function rolepost(Request $request){

    	$this->validate($request, [
            'name' => 'required|string|max:255|unique:roles',
        ]);

    	$role = Role::create(['name' => $request->name]);

    	return back()->with('status', 'Role Generated Success');

    }

    public function roleedit($id, Request $request){
    	$role = Role::find($id);
    	$this->validate($request, [
            'name' => 'required|string|max:255|unique:roles,name,' . $role->id,
        ]);
        if ($role->name == 'admin') {
        	return back()->with('warning', 'This Role Cant Be Edit');
        }
        $role->name = $request->name;
        $role->save();

        return back()->with('status', 'Role Edited Success');
    }

    public function roledelete($id, Request $request){

    	$role = Role::find($id);

    	if ($role->name == 'admin') {
    		return back()->with('warning', 'This Role Cant Be Delete');
    	}

    	$role->delete();

    	return back()->with('status', 'Role Deleted Success');
    }

    public function addPermissionToRole($roleid, Request $request){
        

        $permissions = $request->permissions;

        $role = Role::find($roleid);

        $role->revokePermissionTo(Permission::all());

        foreach ($permissions as $permission) {
            $role->givePermissionTo($permission);
        }

        return back()->with('status', 'Updated Success');

    }
}
