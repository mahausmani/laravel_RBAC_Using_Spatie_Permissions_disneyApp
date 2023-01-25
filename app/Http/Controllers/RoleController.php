<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleController extends Controller
{
    public $user;
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $user = Auth::guard('admin')->user();
            return $next($request);
        });
    }
    public function view()
    {
        $user = Auth::user();
        if (is_null($user) || !$user->can('role.view')) {
            abort(403, 'Sorry !! You are Unauthorized to view any role !');
        }
        $roles = Role::all();
        return $roles;
    }

    public function createForm(){
        $all_permissions  = Permission::all();
        $permission_groups = User::getpermissionGroups();
        return view('role.create', compact('all_permissions', 'permission_groups'));
    }
    public function create(Request $request)
    {
        $user = Auth::user();
        if (is_null($user) || !$user->can('role.create')) {
            abort(403, 'Sorry !! You are Unauthorized to create any role !');
        }
        
        $request->validate([
            'name' => 'required|max:100|unique:roles'
        ], [
            'name.requried' => 'Please give a role name'
            ]);
        $role = Role::create(['name' => $request->name, 'guard_name' => 'admin']);

        $permissions = $request->input('permissions');

        if (!empty($permissions)) {
            $role->syncPermissions($permissions);
        }
        

        return "success, Role has been created !!";
    }

    public function updateForm(){
        $all_permissions  = Permission::all();
        $permission_groups = User::getpermissionGroups();
        $roles = Role::all();
        return view('role.update', compact('all_permissions', 'permission_groups','roles'));
    }
    public function update(Request $request)
    {
        $user = Auth::user();
        if (is_null($user) || !$user->can('role.update')) {
            abort(403, 'Sorry !! You are Unauthorized to edit any role !');
        }
        $role = Role::findByName($request->input('name'), 'admin');
      
        //if ($id === 1) {
          //  return "error', 'Sorry !! You are not authorized to edit this role !";
        //}
        // $request->validate([
        //     'name' => 'required|max:100|unique:roles,name,'
        // ], [
        //     'name.requried' => 'Please give a role name'
        // ]);
        $permissions = $request->input('permissions');
        if (!empty($permissions)) {
            $role->name = $request->newname;
            $role->save();
            $role->syncPermissions($permissions);
        }

        return "Role has been updated";
    }
    public function deleteForm(){
        $roles = Role::all();
        return view('role.delete',compact('roles'));
    }
    public function delete(Request $request)
        {
            
                $user = Auth::user();
                if (is_null($user) || !$user->can('role.delete')) {
                    abort(403, 'Sorry !! You are Unauthorized to delete any role !');
                }
        
                // if ($id === 1) {
                //     return "error, Sorry !! You are not authorized to delete this role !";
                // }
                $role = Role::findByName($request->name, 'admin');
                if (!is_null($role)) {
                    $role->delete();
                }
        
                
                return "success, Role has been deleted !";
            
    }
}
