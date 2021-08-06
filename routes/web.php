<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\LoginController;
use App\Http\Controllers\Admin\RoleController;
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