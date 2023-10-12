<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ExhibitionController;

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

Route::get('/exhibitions', [ExhibitionController::class, 'index']);

Route::get('/profile/{id}', [UserController::class, 'show']);

Route::patch('/change_profile_image', [UserController::class, 'profile_image']);
