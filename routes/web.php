<?php

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

Route::get('/', function() {
    return redirect()->route('users.index');
});

Route::resource('users', App\Http\Controllers\CustomerController::class);

Route::get('users_list', [App\Http\Controllers\CustomerController::class, 'list'])->name('users.list');

