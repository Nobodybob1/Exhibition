<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

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

Route::get('/create_user', [UserController::class, 'create']);
Route::post('/register_user', [UserController::class, 'store']);

Route::get('/login', function() {
    return view('auth.login');
});
Route::post('/login_user', [UserController::class, 'login']);
Route::get('/logout', [UserController::class, 'logout']);
