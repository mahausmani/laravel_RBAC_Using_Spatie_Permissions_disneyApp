<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Models\User;
use App\Models\Character;
use App\Http\Resources\User as UserResource;
use App\Http\Resources\Character as CharacterResource;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class AuthController extends Controller
{
    public function register(Request $request): JsonResponse
    {
        

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'api_token' => $request->api_token
        ]);
        
        $role = Role::findByName('user','admin');
        $user->assignRole($role);
        for($i = 0;$i<count($role->permissions);$i++){
            $permission = $role->permissions[$i];
            $user->givePermissionTo($permission);
        }
        
        // return UserResource::make($user)->response();
        return view('dashboard')->with($user);
        }
    public function registerForm(){
        
            return view('auth/registerr_form');
    }
    public function loginForm(){
        
        return view('auth/login_form');
    }
        
    public function login(Request $request)
    {
            //add request validation
            if (!Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
                return response()->json([
                    'error' => [
                        'password' => 'Wrong credentials are given.'
                        ]
                    ]);
                }
                
            $user = Auth::user();
        
            $request->session()->regenerate();
            return redirect('api/dashboard');//pass user from here to dashboard
    }
    public function logout(Request $request)
    {
        Auth::logout();
        
        $request->session()->invalidate();
    
        $request->session()->regenerateToken();
        // return session()->all();
        return redirect('api/login');
    }
}
