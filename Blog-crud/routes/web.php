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

// Route::get('/', function () {
//     return view('homepage');
// });

Route::get('/login', function () {
    return view('login');
})->name('login');

Route::get('/register', function () {
    return view('register');
})->name('register');

Route::get('/logout', [UserController::class, 'logoutUser'])->name('logout');

Route::get('/editpost', [SiteController::class, 'editPost'])->name('editpost');

Route::get('/editprofile', [SiteController::class, 'editProfile'])->name('editprofile');

Route::get('/details', [SiteController::class, 'getDetails'])->name('details');

Route::get('/favorites', [SiteController::class, 'getFavorites'])->name('favorites');

Route::get('/', [SiteController::class, 'getPosts'])->name('home');

Route::get('/blogs', [SiteController::class, 'getPosts'])->name('blogs');

Route::get('/myposts', [SiteController::class, 'getUserPosts'])->name('myposts');

Route::get('/createblog', [SiteController::class, 'createBlog'])->name('createblog');

Route::get('/deletepost', [SiteController::class, 'deletePost'])->name('deletepost');

Route::post('/registeruser', [UserController::class, 'registerUser'])->name('registeruser');

Route::post('/getBlogData', [SiteController::class, 'getBlogData'])->name('getBlogData');

Route::post('/loginuser', [UserController::class, 'loginUser'])->name('loginuser');

Route::post('/updateprofile', [UserController::class, 'editProfile'])->name('updateprofile');

Route::post('/createpost', [SiteController::class, 'createPost'])->name('createpost');

Route::post('/updatepost', [SiteController::class, 'updatePost'])->name('updatepost');

Route::get('/togglepost', [SiteController::class, 'togglePost'])->name('togglepost');
