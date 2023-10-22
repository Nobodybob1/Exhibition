<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\RatingController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\ExhibitionController;
use App\Http\Controllers\UserFavoriteController;

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

Route::middleware('admin')->group(function () {
    Route::get('/admin', function() {
        return view('admin');
    });
        Route::get('/admin_artists', [AdminController::class, 'show']);
        Route::patch('/block_artist/{id}', [AdminController::class, 'update']);

        Route::get('/add_artist', [AdminController::class, 'create']);
        Route::post('/create_artist', [AdminController::class, 'store']);

        Route::get('/admin_arts', [AdminController::class, 'arts']);

        Route::delete('/delete_art/{id}', [AdminController::class, 'destroy']);
        Route::delete('/delete_comment/{id}', [AdminController::class, 'delete_comment']);
});

Route::get('/create_user', [UserController::class, 'create']);
Route::post('/register_user', [UserController::class, 'store']);

Route::get('/login', function() {
    return view('auth.login');
})->name('login');
Route::post('/login_user', [UserController::class, 'login']);
Route::get('/logout', [UserController::class, 'logout']);

Route::get('/exhibitions', [ExhibitionController::class, 'index']);
Route::get('/exhibition_single/{id}', [ExhibitionController::class, 'show'])->middleware('auth');

Route::get('/profile/{id}', [UserController::class, 'show'])->middleware('auth');

Route::patch('/change_profile_image', [UserController::class, 'profile_image']);

Route::get('/exhibition_create', [ExhibitionController::class, 'create'])->middleware('auth');
Route::post('/exhibition_store', [ExhibitionController::class, 'store']);

Route::post('/rate_art/{id}', [RatingController::class, 'store']);
Route::patch('/update_rate_art/{id}', [RatingController::class, 'update']);

Route::get('/art_update/{id}', [ExhibitionController::class, 'edit']);
Route::patch('/art_update/{id}', [ExhibitionController::class, 'update']);

Route::post('/art/{id}/comment', [CommentController::class, 'store']);

Route::post('/add_favorite/{id}', [UserFavoriteController::class, 'store']);

Route::get('/social-media-share', [SocialShareButtonsController::class,'ShareWidget']);

Route::get('/art/search', [ExhibitionController::class, 'index']);