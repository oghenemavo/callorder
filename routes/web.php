<?php

use App\Http\Controllers\Admin\{DashboardController, LoginController, PermissionController, RoleController, SupermarketController, UserController};
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

Route::name('admin.')->group(function() {

    Route::prefix('admin')->group(function() {
        Route::get('/', [LoginController::class, 'login'])->name('login');
        Route::get('login', [LoginController::class, 'login']);
        Route::post('login/authenticate', [LoginController::class, 'authenticate'])->name('authenticate');

        Route::middleware(['auth', 'role:admin'])->group(function() {
            Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');
            Route::get('logout', [DashboardController::class, 'logout'])->name('logout');
            
            Route::prefix('authorization')->group(function() {
                Route::get('roles', [RoleController::class, 'index'])->name('auth.roles');
                Route::post('create/role', [RoleController::class, 'createRole'])->name('auth.create.role');
                Route::put('update/role/{role}', [RoleController::class, 'updateRole'])->name('auth.update.role');
                Route::delete('delete/role/{role}', [RoleController::class, 'deleteRole'])->name('auth.delete.role');
                Route::get('role/{role}/permissions', [RoleController::class, 'permissions'])->name('auth.role.permissions');
                Route::put('attach/role/{role}/permission', [RoleController::class, 'attachPermission'])->name('auth.attach.role_permission');
                Route::put('detach/role/{role}/permission', [RoleController::class, 'detachPermission'])->name('auth.detach.role_permission');
                
                Route::get('permissions', [PermissionController::class, 'index'])->name('auth.permissions');
                Route::post('create/permission', [PermissionController::class, 'createPermission'])->name('auth.create.permission');
                Route::put('update/permission/{permission}', [PermissionController::class, 'updatePermission'])->name('auth.update.permission');
                Route::delete('delete/permission/{permission}', [PermissionController::class, 'deletePermission'])->name('auth.delete.permission');
            });

            Route::prefix('manage')->name('manage.')->group(function() {
                Route::get('users', [UserController::class, 'index'])->name('users');
                Route::post('create/user', [UserController::class, 'create'])->name('create.user');
                Route::put('edit/user/{user}', [UserController::class, 'edit'])->name('edit.user');
                Route::put('deactivate/user/{user}', [UserController::class, 'deactivate'])->name('deactivate.user');
                Route::put('activate/user/{user}', [UserController::class, 'activate'])->name('activate.user');
                
                Route::get('supermarkets', [SupermarketController::class, 'index'])->name('supermarket');
                Route::post('create/market', [SupermarketController::class, 'create'])->name('create.market');
                Route::put('edit/supermarkets/{supermarket}', [SupermarketController::class, 'edit'])->name('edit.market');
            });
            
        });
    });

});

// Route::name('admin')->group(function() {

//     Route::prefix('admin')->group(function() {
//         Route::get('login', [LoginController::class, 'login'])->name('auth.login');

//         Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
//     });

// });

// Route::name('admin')->group(function() {

//     Route::prefix('admin')->group(function() {
//         Route::get('login', [LoginController::class, 'login'])->name('auth.login');

//         Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
//     });

// });