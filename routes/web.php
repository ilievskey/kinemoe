<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ReportController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;



// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes();

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/tos', [HomeController::class, 'tos'])->name('terms');
Route::get('/content/{content}', [HomeController::class, 'show'])->name('content.show');

Route::get('/posts', [PostController::class, 'posts'])->name('posts.index');
Route::get('/post/{post}', [PostController::class, 'show'])->name('post.show');


Route::middleware(['auth', 'check.banned'])->group(function () {
    // dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::post('/dashboard/update', [DashboardController::class, 'update'])->name('dashboard.update');

    // posts management
    Route::get('/posts/create', [PostController::class, 'create'])->name('posts.create');
    Route::post('/post', [PostController::class, 'store'])->name('post.store');

    // comments storing
    Route::post('/post/{post}/comments', [CommentController::class, 'store'])->name('post.comments.store'); //show comments on post
    
    //reports handling by user
    Route::post('/report/post/{post}', [ReportController::class, 'reportPost'])->name('report.post');
    Route::post('/report/comment/{comment}', [ReportController::class, 'reportComment'])->name('report.comment');

    //post and comment deletion
    Route::delete('/posts/{post}', [PostController::class, 'destroy'])->name('posts.destroy');
    Route::delete('/comments/{comment}', [CommentController::class, 'destroy'])->name('comments.destroy');

    // like logic
    Route::post('/toggle-like', [LikeController::class, 'toggleLike'])->name('toggle-like');
});


Route::middleware(['auth', 'admin'])->group(function () {
    // admin dashboard
    Route::get('/admin/home', [AdminController::class, 'home'])->name('admin.home');
    Route::get('/admin/users', [AdminController::class, 'users'])->name('admin.users');
    Route::get('/admin/content', [AdminController::class, 'content'])->name('admin.content');
    Route::get('/admin/reports', [AdminController::class, 'reports'])->name('admin.reports');
    Route::get('/admin/settings', [AdminController::class, 'settings'])->name('admin.settings');
    
    // admin user search logic
    Route::get('/admin/search-users', [AdminController::class, 'searchUsers'])->name('admin.search-users');

    // admin change other user
    Route::get('/admin/users/{user}/edit', [AdminController::class, 'editUser'])->name('admin.users.edit');
    Route::put('/admin/users/{user}/update', [AdminController::class, 'updateUser'])->name('admin.users.update');
    Route::delete('/admin/users/{user}/delete', [AdminController::class, 'deleteUser'])->name('admin.users.delete');

    //admin crud content
    Route::get('/admin/content', [AdminController::class, 'content'])->name('admin.content');
    Route::get('/admin/content/create-content', [AdminController::class, 'createContent'])->name('admin.content.create-content');
    Route::post('/admin/content', [AdminController::class, 'storeContent'])->name('admin.content.store');
    Route::get('/admin/content/{content}/edit', [AdminController::class, 'editContent'])->name('admin.content.edit');
    Route::put('/admin/content/{content}', [AdminController::class, 'updateContent'])->name('admin.content.update');
    Route::delete('/admin/content/{content}', [AdminController::class, 'deleteContent'])->name('admin.content.delete');

    // admin edit posts and comments
    Route::get('/admin/users/{user}/posts/{post}/edit', [AdminController::class, 'editPost'])->name('admin.usercontent.edit-post');
    Route::put('/admin/users/{user}/posts/{post}', [AdminController::class, 'updatePost'])->name('admin.usercontent.update-post');
    Route::get('/admin/users/{user}/comments/{comment}/edit', [AdminController::class, 'editComment'])->name('admin.usercontent.edit-comment');
    Route::put('/admin/users/{user}/comments/{comment}', [AdminController::class, 'updateComment'])->name('admin.usercontent.update-comment');

    // admin set post to be highlighted
    Route::patch('/posts/{post}/highlight', [PostController::class, 'highlight'])->name('posts.highlight');

    // admin delete other user post/comment
    Route::delete('/admin/posts/{post}', [AdminController::class, 'deletePost'])->name('admin.posts.delete');
    Route::delete('/admin/comments/{comment}', [AdminController::class, 'deleteComment'])->name('admin.comments.delete');

    // admin respond to reports
    Route::get('/admin/reports', [AdminController::class, 'showReports'])->name('admin.reports');
    Route::delete('/admin/reports/{report}', [AdminController::class, 'deleteReport'])->name('admin.reports.delete');
    Route::post('/admin/reports/{report}/dismiss', [AdminController::class, 'dismissReport'])->name('admin.reports.dismiss');

    //store and edit system settings
    Route::get('/admin/settings', [AdminController::class, 'settings'])->name('admin.settings');
    Route::put('/admin/settings', [AdminController::class, 'settingsUpdate'])->name('admin.settings.update');
    
});

