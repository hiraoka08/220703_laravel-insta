<?php

use Illuminate\Support\Facades\Route;

#Admin Controllers
use App\Http\Controllers\Admin\UsersController;
use App\Http\Controllers\Admin\PostsController;
use App\Http\Controllers\Admin\CategoriesController;

#User Controllers
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\FollowController;

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

Auth::routes();

Route::group(['prefix' => 'admin', 'as' => 'admin.', 'middleware' => 'admin'], function(){
    // USER
    Route::get('/users', [UsersController::class, 'index'])->name('users');
    Route::delete('/users/{id}/deactivate', [UsersController::class, 'deactivate'])->name('users.deactivate');
    Route::patch('/users/{id}/activate', [UsersController::class, 'activate'])->name('users.activate');

    // POST
    Route::get('/posts', [PostsController::class, 'index'])->name('posts');
    Route::delete('/posts/{id}/hide', [PostsController::class, 'hide'])->name('posts.hide');
    Route::patch('/posts/{id}/unhide', [PostsController::class, 'unhide'])->name('posts.unhide');

    // CATEGORY
    Route::get('/categories', [CategoriesController::class, 'index'])->name('categories');
    Route::post('/categories/store', [CategoriesController::class, 'store'])->name('categories.store');
    Route::get('/categories/{id}/edit', [CategoriesController::class, 'edit'])->name('categories.edit');
    Route::patch('/categories/{id}/update', [CategoriesController::class, 'update'])->name('categories.update');
    Route::delete('/categories/{id}/delete', [CategoriesController::class, 'destroy'])->name('categories.destroy');

});

Route::group(['middleware' => 'auth'], function(){
    Route::get('/', [HomeController::class, 'index'])->name('index');
    Route::get('/explore/people', [HomeController::class, 'showSuggestedUsers'])->name('showSuggestedUsers');

    // POST
    Route::get('/post/create', [PostController::class, 'create'])->name('post.create');
    Route::post('/post/store', [PostController::class, 'store'])->name('post.store');
    Route::get('/post/{id}/show', [PostController::class, 'show'])->name('post.show');
    Route::get('/post/{id}/edit', [PostController::class, 'edit'])->name('post.edit');
    Route::patch('/post/{id}/update', [PostController::class, 'update'])->name('post.update');
    Route::delete('/post/{id}/delete', [PostController::class, 'destroy'])->name('post.destroy');
    
    Route::post('/comment/{post_id}/store', [CommentController::class, 'store'])->name('comment.store');
    Route::delete('/comment/{id}/delete', [CommentController::class, 'deleteComment'])->name('comment.deleteComment');

    // PROFILE
    Route::get('profile/{id}/show', [ProfileController::class, 'show'])->name('profile.show');
    Route::get('profile/{id}/followers', [ProfileController::class, 'followers'])->name('profile.followers');
    Route::get('profile/{id}/following', [ProfileController::class, 'following'])->name('profile.following');
    Route::get('profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('profile/update', [ProfileController::class, 'update'])->name('profile.update');
    

    // LIKE
    Route::post('/like/{post_id}/store', [LikeController::class, 'store'])->name('like.store');
    Route::delete('/like/{post_id}/delete', [LikeController::class, 'destroy'])->name('like.destroy');

    // FOLLOW
    Route::post('/follow/{id}/store', [FollowController::class, 'store'])->name('follow.store');
    Route::delete('/follow/{id}/delete', [FollowController::class, 'destroy'])->name('follow.destroy');


});