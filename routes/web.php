<?php

use App\Http\Controllers\RoleAndPermissionController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/home', function () {
    return view('welcome');
});

Route::get('/logout', function () {
    Auth::logout();
    return redirect()->back();
});

Route::get('dashboard', function () {
    return view('backend.dashboard.index');
})->name('dashboard');

Route::get('user-list', [UserController::class, 'index'])->name('user-list');
Route::get('roles', [RoleAndPermissionController::class, 'indexRole'])->name('roles');

Route::post('store-role-ajax', [RoleAndPermissionController::class, 'storeRoleAjax']);
Route::post('update-role-ajax', [RoleAndPermissionController::class, 'updateRoleAjax']);
