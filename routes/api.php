<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CharacterController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

 
//register user
Route::post('/register',  [AuthController::class, 'register'])->name('register')->middleware('guest');
Route::get('/register',  [AuthController::class, 'registerForm'])->name('register')->middleware('guest');
Route::get('login',  [AuthController::class, 'loginForm'])->name('login')->middleware('guest');
Route::post('login',  [AuthController::class, 'login'])->name('login')->middleware('guest');
Route::middleware("auth")->group(function(){
        Route::get('/dashboard',function(){
                return view('dashboard');
        });
        
        Route::post('/character/create',  [CharacterController::class, 'create'])->name('create-character');
        Route::get('/character/create',  [CharacterController::class, 'createForm'])->name('create-character');
        Route::get('/show-all-characters',  [CharacterController::class, 'view'])->name('show-characters');
        Route::post('/character/update',  [CharacterController::class, 'update'])->name('update-character');
        Route::get('/character/update',  [CharacterController::class, 'updateForm'])->name('update-character');
        Route::post('/character/delete',  [CharacterController::class, 'delete'])->name('delete-character');
        Route::get('/character/delete',  [CharacterController::class, 'deleteForm'])->name('delete-character');
        Route::post('/vote',  [UserController::class, 'vote'])->name('vote-character');
        Route::get('/vote',  [UserController::class, 'voteForm'])->name('vote-character');
 
        Route::get('/get-user',[UserController::class,'view_user'])->name('get-user');
        Route::get('/show-all-users',[UserController::class,'view'])->name('show-users');
        Route::post('/update-user',[UserController::class,'update'])->name('update-user');
        Route::get('/update-user',[UserController::class,'updateForm'])->name('update-user');
        Route::post('/delete-user',[UserController::class,'delete'])->name('delete-user');
        Route::get('/delete-user',[UserController::class,'deleteForm'])->name('delete-user');
        Route::post('/create-user',[UserController::class,'create'])->name('create-user');
        Route::get('/create-user',[UserController::class,'createForm'])->name('create-user');

        Route::get('/show-all-roles',[RoleController::class,'view'])->name('show-roles');
        Route::get('/update-role',[RoleController::class,'updateForm'])->name('update-role');
        Route::post('/update-role',[RoleController::class,'update'])->name('update-role');
        Route::post('/delete-role',[RoleController::class,'delete'])->name('delete-role');
        Route::get('/delete-role',[RoleController::class,'deleteForm'])->name('delete-role');
        Route::get('/create-role',[RoleController::class,'createForm']);
        Route::post('/create-role',[RoleController::class,'create'])->name('create-role');

        
        Route::post('/logout',[AuthController::class,'logout'])->name('logout');
});
