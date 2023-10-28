<?php

use App\Http\Controllers\UserController;
use App\Http\Controllers\SiteController;
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
    return view('homepage');
});

Route::get('/login', function () {
    return view('login');
});

Route::get('/register', function () {
    return view('register');
});

Route::get('/logout', [UserController::class, 'logoutUser']);

Route::get('/editPost', [SiteController::class, 'editPost']);

Route::get('/favorites', [SiteController::class, 'getFavorites']);

Route::get('/blogs', [SiteController::class, 'getPosts']);

Route::get('/myposts', [SiteController::class, 'getUserPosts']);

Route::get('/createblog', [SiteController::class, 'createBlog']);

Route::get('/deletepost', [SiteController::class, 'deletePost']);

Route::post('/registeruser', [UserController::class, 'registerUser']);

Route::post('/loginuser', [UserController::class, 'loginUser']);

Route::post('/createpost', [SiteController::class, 'createPost']);

Route::post('/updatepost', [SiteController::class, 'updatePost']);
