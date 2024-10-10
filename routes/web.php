<?php

use App\Http\Controllers\CMS\GroupMenu\GroupMenuController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
});

// Group Menu View
Route::group([

    'namespace' => 'GroupMenu',
    'domain' => config('backend.route.domain'),
    'prefix' => config('backend.route.prefix')

], function () {
    Route::get('/group-menu', [GroupMenuController::class, 'index'])->name('group_menu');
    Route::get('/group-menu/create', [GroupMenuController::class, 'create']);
    Route::get('/group-menu/show/{id}', [GroupMenuController::class, 'show']);
    Route::post('/group-menu/store', [GroupMenuController::class, 'store']);
    Route::get('/group-menu/edit/{id}', [GroupMenuController::class, 'edit']);
    Route::post('/group-menu/delete', [GroupMenuController::class, 'delete']);
    Route::get('/group-menu/fn_get_data', [GroupMenuController::class, 'fnGetData']);
});
