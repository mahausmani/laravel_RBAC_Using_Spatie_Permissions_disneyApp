<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Character;
use App\Http\Resources\User as UserResource;
use App\Http\Resources\Character as CharacterResource;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $this->user = Auth::guard('admin')->user();
            return $next($request);
        });
    }
    public function updateForm(){
        $roles = Role::all();
        return view('user.update', compact('roles'));
    }
    public function update(Request $request ){
        $user = Auth::user();
        if (is_null($user) || !$user->can('user.update')) {
            abort(403, 'Sorry !! You are Unauthorized to update any user !');
        }
        $user = User::select('*')->where('name', $request->name)->first();
        $user->name = $request['newname'];
        $user->email = $request['email'];
        $user->password = $request['password'];

        $user->save();
        //revoke all roles of users
        $user->syncRoles([]);
        $user->syncPermissions([]);
        $roles = $request->roles;
        for ($j = 0;$j<count($roles);$j++){
            $role = Role::findByName($roles[$j],'admin');
            $user->assignRole($role);
            for($i = 0;$i<count($role->permissions);$i++){
                $permission = $role->permissions[$i];
                $user->givePermissionTo($permission);
    
        
        return "user {$request->name} has been updated";
    }}}
    public function viewUserForm(){
        return view('user.view');
    }

    public function view_user(Request $request){
        if (is_null($this->user) || !$this->user->can('user.view_user')) {
            abort(403, 'Sorry !! You are Unauthorized to view any other user !');
        }
        $user = User::select('*')->where('id', $request->id)->first();
        return $user;
    }
    
    public function view(){
        $user = Auth::user();
        if (is_null($user) || !$user->can('user.view')) {
            abort(405, 'Sorry !! You are Unauthorized to view any users!');
        }
        $users = User::all();
        return $users;
    }
    public function createForm(){
        $roles = Role::all();
        return view('user.create', compact('roles'));
    }
    public function create(Request $request){
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'api_token' => $request->api_token
        ]);
        $user->save();
        $roles = $request->roles;
        $permissions = $request->input('permissions');
        for ($j = 0;$j<count($roles);$j++){
            $role = Role::findByName($roles[$j],'admin');
            $user->assignRole($role);
            for($i = 0;$i<count($role->permissions);$i++){
                $permission = $role->permissions[$i];
                $user->givePermissionTo($permission);
            }
        }
        
        return "user {$request->name} has been created";
    }
    public function deleteForm(){
        
        $users = User::all();
        return view('user.delete', compact('users'));
    }
    public function delete(Request $request){
        $user = Auth::user();
        if (is_null($user) || !$user->can('user.delete')) {
            abort(403, 'Sorry !! You are U nauthorized to delete any user!');
        }

        //if ($id === 1) {
        //    return "error, Sorry !! You are not authorized to delete this user!";
        //}

        $user = User::select('*')->where('name', $request->name)->first();
        if (!is_null($user)) {
            $user->delete();
        }

        
        return "success, User {$request->name} has been deleted !";
    }

    public function voteForm(){
        $characters = Character::all();
        return view('user.vote',compact('characters'));

    }
    public function vote(Request $request)
    {
        $user = Auth::user();
        if (is_null($user) || !$user->can('character.vote')) {
            abort(403, 'Sorry !! You are Unauthorized to vote for any character!');
        }
        $characterId = Character::select('*')->where('name', $request->name)->first()->id;
        $user->voteCharacter()->attach($characterId);
        return "vote has been casted";
    }

}
