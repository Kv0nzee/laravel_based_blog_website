<?php

use App\Http\Controllers\AdminBlogController;
use App\Http\Controllers\authController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\CommentController;
use Illuminate\Support\Facades\Route;
use App\Models\User;

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

Route::get('/', [BlogController::class,'index']);

Route::get('/blogs/{blog:slug}', [BlogController::class,'show'])->where('blog', '[A-z\d\-_]+');
//whereAlpha

Route::post('/blogs/{blog:slug}/comments', [CommentController::class,'store'])->where('blog', '[A-z\d\-_]+');
Route::post('/blogs/{blog:slug}/subscription', [BlogController::class, 'subscriptionHandler']);

Route::get('/register', [authController::class, 'create'])->middleware('guest');
Route::post('/register', [authController::class,'store'])->middleware('guest');
Route::post('/logout', [authController::class,'logout'])->middleware('auth');

Route::get('/login', [authController::class, 'login'])->middleware('guest');
Route::post('/login', [authController::class, 'post_login'])->middleware('guest');
//admin routes

Route::middleware("can:admin")->group(function(){
    Route::get('/admin/blogs/', [AdminBlogController::class, 'index']);
    Route::get('/admin/blogs/create', [AdminBlogController::class, 'create']);
    Route::post('/admin/blogs/store', [AdminBlogController::class, 'store']);
    Route::delete('/admin/blogs/{blog:slug}/delete', [AdminBlogController::class, 'destory']);
    Route::get('/admin/blogs/{blog:slug}/edit', [AdminBlogController::class, 'edit']);
    Route::patch('/admin/blogs/{blog:slug}/update', [AdminBlogController::class, 'update']);
});

//single
// Route::get('/admin/blogs/', [AdminBlogController::class, 'index'])->middleware('admin');
// Route::get('/admin/blogs/create', [AdminBlogController::class, 'create'])->middleware('admin');//with miidleware
// Route::post('/admin/blogs/store', [AdminBlogController::class, 'store'])->middleware('admin');
// Route::delete('/admin/blogs/{blog:slug}/delete', [AdminBlogController::class, 'destory'])->middleware('can:admin');
// Route::get('/admin/blogs/{blog:slug}/edit', [AdminBlogController::class, 'edit'])->middleware('can:admin');//with gate
// Route::patch('/admin/blogs/{blog:slug}/update', [AdminBlogController::class, 'update'])->middleware('can:admin');

// Route::get("/categories/{category:slug}", function(Category $category){
//     return view("blogs", [
//         'categories'=>Category::all(),
//         'blogs' => $category->blogs,
//         'currentCategory'=>$category
//     ]);
// });

// Route::get("/authors/{author:username}", function(User $author){
//     return view("blogs", [
//         'blogs' => $author->blogs
//         // 'blogs' => $author->blogs->load('author', 'category'),//obj t ku ka lr dx stage
//     ]);
// });