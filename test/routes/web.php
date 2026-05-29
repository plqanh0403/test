<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\CategoryController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\SubmitContactController;
use App\Http\Controllers\Admin\SubmitEmailController;
use App\Http\Controllers\Admin\BlogController;

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

        Route::post('/users', [UserController::class, 'store'])->name('admin.users.store');

        Route::put('/users/{user}', [UserController::class, 'update'])->name('admin.users.update');

        Route::put('/users/{user}/lock', [UserController::class, 'lock'])->name('admin.users.lock');

        Route::put('/users/{user}/unlock', [UserController::class, 'unlock'])->name('admin.users.unlock');

        Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('admin.users.destroy');

        // Blog Category Management
        Route::get('/categories', [CategoryController::class, 'index'])->name('admin.categories');

        Route::post('/categories', [CategoryController::class, 'store']) ->name('admin.categories.store');

        Route::put('/categories/{category}', [CategoryController::class, 'update']) ->name('admin.categories.update');

        Route::delete('/categories/{category}', [CategoryController::class, 'destroy'])->name('admin.categories.destroy');

        // Blog Management
        Route::get('/blogs', [BlogController::class, 'index'])->name('admin.blogs');

        Route::post('/blogs', [BlogController::class, 'store'])->name('admin.blogs.store');

        Route::put('/blogs/{blog}', [BlogController::class, 'update'])->name('admin.blogs.update');
        
        Route::delete('/blogs/{blog}', [BlogController::class, 'destroy'])->name('admin.blogs.destroy');

        // Submit Email Management
        Route::get('/submit-emails', [SubmitEmailController::class, 'emailIndex'])->name('admin.submit_emails');
        Route::put('/submit-emails/{submitEmail}', [SubmitEmailController::class, 'updateEmailStatus'])->name('admin.submit_emails.update_status');
        Route::delete('/submit-emails/{submitEmail}', [SubmitEmailController::class, 'destroyEmail'])->name('admin.submit_emails.destroy');

        // Submit Contact Management
        Route::get('/submit-contacts', [SubmitContactController::class, 'index'])->name('admin.submit_contacts');

        Route::put('/submit-contacts/{submitContact}', [SubmitContactController::class, 'update'])->name('admin.submit_contacts.update');

        Route::put('/submit-contacts/{submitContact}/seen', [SubmitContactController::class, 'updateSeenStatus'])->name('admin.submit_contacts.update_seen');

        Route::put('/submit-contacts/{submitContact}/processing', [SubmitContactController::class, 'updateProcessingStatus'])->name('admin.submit_contacts.update_processing');

        Route::put('/submit-contacts/{submitContact}/processed', [SubmitContactController::class, 'updateProcessedStatus'])->name('admin.submit_contacts.update_processed');

        Route::delete('/submit-contacts/{submitContact}', [SubmitContactController::class, 'destroy'])->name('admin.submit_contacts.destroy');

        Route::put('/submit-contacts/{submitContact}/note', [SubmitContactController::class, 'updateNote'])->name('admin.submit_contacts.update_note');

        Route::get('/submit-contacts/export', [SubmitContactController::class, 'export'])->name('admin.submit_contacts.export');

        // Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
        // Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
        // Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
