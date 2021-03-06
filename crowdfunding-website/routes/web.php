<?php

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

Route::get('/route-1', function () {
    return 'halaman user';
})->middleware('email.verifikasi');

Route::get('/route-2', function () {
    return 'halaman admin';
})->middleware(['admin', 'email.verifikasi']);

Route::get('/', function () {
    return view('app');
});
Route::view('/{any?}', 'app')->where('any', '.*');



Auth::routes();
