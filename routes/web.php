<?php

use App\Http\Controllers\Admin\{DashboardController, LoginController, PermissionController, RoleController, SupermarketController, UserController};
use App\Http\Controllers\Agent\DashboardController as AgentDashboardController;
use App\Http\Controllers\Agent\LoginController as AgentLoginController;
use App\Http\Controllers\Agent\ProductController;
use App\Http\Controllers\Supermarket\DashboardController as SupermarketDashboardController;
use App\Http\Controllers\Supermarket\LoginController as SupermarketLoginController;
use App\Http\Controllers\AjaxController;
use App\Http\Controllers\HomeController;
use App\Models\Supermarket;
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
    $data['locations'] = Supermarket::select('lga')->distinct()->groupBy('lga')->get();
    return view('welcome', $data);
});

Route::get('purchase/items/{slug}', [HomeController::class, 'purchase'])->name('purchase.items');
Route::post('make/items/payment/{slug}', [HomeController::class, 'payment'])->name('make.items.payment');
Route::get('verify/transaction', [HomeController::class, 'verifyTransaction'])->name('verify.transaction');
Route::get('transaction/notification', [HomeController::class, 'transactionStatus'])->name('transaction.status');
Route::post('create/order', [HomeController::class, 'createOrder'])->name('create.order');

Route::name('ajax.')->group(function() {
    Route::prefix('ajax/get')->group(function() {

        Route::get('all/products', [AjaxController::class, 'products'])->name('all.products');
        Route::get('merchant/{supermarket_id}/products', [AjaxController::class, 'merchantProducts'])->name('merchant.products');
        Route::get('search/{location}/{products}', [AjaxController::class, 'searchProduct'])->name('search.products');

        Route::get('cart', [AjaxController::class, 'getCart'])->name('get.cart');
    });

    Route::post('ajax/add-to-cart', [AjaxController::class, 'addToCart'])->name('add.to.cart');
    Route::post('ajax/remove-from-cart', [AjaxController::class, 'removeCartItem'])->name('remove.from.cart');
});

Route::name('admin.')->group(function() {
    Route::prefix('admin')->group(function() {
        Route::get('/', [LoginController::class, 'login'])->name('login');
        Route::get('login', [LoginController::class, 'login']);
        Route::post('login/authenticate', [LoginController::class, 'authenticate'])->name('authenticate');

        Route::middleware(['auth', 'role:admin'])->group(function() {
            Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');
            Route::get('logout', [LoginController::class, 'logout'])->name('logout');
            
            Route::get('products', [DashboardController::class, 'products'])->name('products');
            Route::get('orders', [DashboardController::class, 'orders'])->name('orders');
            Route::get('orders/fulfilment', [DashboardController::class, 'fulfilment'])->name('orders.fulfilment');

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

Route::name('supermarket.')->group(function() {
    
    Route::prefix('supermarket')->group(function() {
        Route::get('/', [SupermarketLoginController::class, 'login'])->name('login');
        Route::post('login/authenticate', [SupermarketLoginController::class, 'authenticate'])->name('authenticate');

        Route::middleware(['auth', 'role:merchant'])->group(function() {
            Route::get('dashboard', [SupermarketDashboardController::class, 'index'])->name('dashboard');
            Route::get('logout', [SupermarketLoginController::class, 'logout'])->name('logout');
            
            Route::get('products', [SupermarketDashboardController::class, 'products'])->name('products');
            Route::put('update/product', [SupermarketDashboardController::class, 'updateProduct'])->name('update.product');
            Route::delete('delete/product', [SupermarketDashboardController::class, 'deleteProduct'])->name('delete.product');
            
            Route::get('manage/account', [SupermarketDashboardController::class, 'account'])->name('manage.account');
            Route::put('manage/update/password', [SupermarketDashboardController::class, 'password'])->name('update.password');

            Route::post('upload/inventory', [SupermarketDashboardController::class, 'uploadInventory'])->name('upload.inventory');

        });
        

    });

});

Route::name('agent.')->group(function() {
    
    Route::prefix('agent')->group(function() {
        Route::get('/', [AgentLoginController::class, 'index'])->name('index');
        Route::post('authenticate', [AgentLoginController::class, 'authenticate'])->name('authenticate');
        
        Route::middleware(['auth', 'role:agent'])->group(function() {
            Route::get('logout', [AgentLoginController::class, 'index'])->name('logout');
            Route::get('dashboard', [AgentDashboardController::class, 'index'])->name('dashboard');
            
            Route::post('add-to-cart', [ProductController::class, 'addToCart'])->name('add.to.cart');
            Route::post('remove-from-cart', [ProductController::class, 'removeFromCart'])->name('remove.from.cart');
            Route::put('update-cart-item-quantity', [ProductController::class, 'updateCartItemQuantity'])->name('update.cart.item.quantity');
            Route::delete('delete-from-cart', [ProductController::class, 'deleteFromCart'])->name('delete.from.cart');
            Route::delete('empty-cart', [ProductController::class, 'emptyCart'])->name('empty.cart');

            Route::post('create/order', [ProductController::class, 'createOrder'])->name('create.order');
            
            Route::get('cart', [AgentDashboardController::class, 'cart'])->name('cart');
            Route::get('orders', [AgentDashboardController::class, 'orders'])->name('orders');
            Route::get('fulfilment', [AgentDashboardController::class, 'fulfilment'])->name('fulfilment');
            Route::put('deliver/order/{order}', [AgentDashboardController::class, 'deliverOrder'])->name('deliver.order');
            
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