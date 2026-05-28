<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\CategoryController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    // return redirect()->route('login');
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')
    ->prefix('admin')
    ->group(function () {

        Route::get('/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');

        // User Management
        Route::get('/users', [UserController::class, 'index'])->name('admin.users');

        Route::get('/users/create', [UserController::class, 'create'])->name('admin.users.create');

        Route::get('/users/{user}', [UserController::class, 'detail'])->name('admin.users.show');

        Route::post('/users', [UserController::class, 'store'])->name('admin.users.store');

        Route::get('/users/{user}/edit', [UserController::class, 'edit'])->name('admin.users.edit');

        Route::put('/users/{user}', [UserController::class, 'update'])->name('admin.users.update');

        Route::put('/users/{user}/lock', [UserController::class, 'lock'])->name('admin.users.lock');

        Route::put('/users/{user}/unlock', [UserController::class, 'unlock'])->name('admin.users.unlock');

        Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('admin.users.destroy');

        // Blog Category Management
        Route::get('/categories', [CategoryController::class, 'index'])->name('admin.categories');

        Route::get('/categories/create', [CategoryController::class, 'create']) ->name('admin.categories.create');

        Route::post('/categories', [CategoryController::class, 'store']) ->name('admin.categories.store');

        Route::get('/categories/{category}/edit', [CategoryController::class, 'edit']) ->name('admin.categories.edit');

        Route::put('/categories/{category}', [CategoryController::class, 'update']) ->name('admin.categories.update');

        Route::delete('/categories/{category}', [CategoryController::class, 'destroy'])->name('admin.categories.destroy');

        // Blog Management

        // Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
        // Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
        // Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
