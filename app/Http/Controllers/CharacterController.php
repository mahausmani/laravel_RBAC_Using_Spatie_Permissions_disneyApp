<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Character;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Http\Resources\Character as CharacterResource;

class CharacterController extends Controller
{
 
    public function view()
    {
        $user = Auth::user();
        if (is_null($user) || !$user->can('character.view')) {
            abort(403, 'Sorry !! You are Unauthorized to view any character!');
        }
        $characters = Character::get();
        return view('character.view',compact('characters'));
    }
    public function createForm(){
        return view('character.create');
    }

    public function create(Request $request)
    {
        $user = Auth::user();
        if (is_null($user) || !$user->can('character.create')) {
            abort(403, 'Sorry !! You are Unauthorized to create any character!');
        }
        $character = Character::create([
            'name' => $request->name,
        ]);
        return "Character created {$request->name}";
    }

    public function updateForm(){
        return view('character.update');
    }
    public function update(Request $request){
        $user = Auth::user();
        if (is_null($user) || !$user->can('role.update')) {
            abort(403, 'Sorry !! You are Unauthorized to edit any role !');
        }
        
        $character = Character::select('*')->where('name', $request->name)->first();
        if (!is_null($character) ){
            $character->name = $request->newname;
            $character->save();
        }
        return "Character updated";
    }
    public function deleteForm(){
        return view('character.delete');
    }
    public function delete(Request $request){
        $user = Auth::user();
        if (is_null($user) || !$user->can('character.delete')) {
            abort(403, 'Sorry !! You are Unauthorized to delete any character!');
        }

        $character = Character::select('*')->where('name', $request->name)->first();
        if (!is_null($character) ){
            $character->delete();
        }

        
        return "success, Character has been deleted !";
    }
    
}
