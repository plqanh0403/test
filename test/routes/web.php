<?php

use App\Http\Controllers\Admin\AboutUsController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\CategoryController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\SubmitContactController;
use App\Http\Controllers\Admin\SubmitEmailController;
use App\Http\Controllers\Admin\BlogController;
use App\Http\Controllers\Admin\CKEditorController;
use App\Http\Controllers\Admin\RecruitmentController;
use App\Http\Controllers\Admin\ServiceController;
use App\Http\Controllers\Viewer\HomeController;
use App\Http\Controllers\viewer\ViewerAboutUsController;
use App\Http\Controllers\Viewer\ViewerBlogController;
use App\Http\Controllers\Viewer\ViewerContactController;
use App\Http\Controllers\Viewer\ViewerEmailController;
use App\Http\Controllers\Viewer\ViewerServiceController;
use App\Http\Controllers\Viewer\ViewerRecruitmentController;

Route::get('/', [HomeController::class, 'home'])->name('home');
Route::get('/services/category/{slug}', [ViewerServiceController::class, 'index'])->name('viewer.services.index');
Route::get('/services/{slug}', [ViewerServiceController::class, 'show'])->name('viewer.services.show');
Route::get('/recruitments', [ViewerRecruitmentController::class, 'index'])->name('viewer.recruitments.index');
Route::get('/recruitments/{slug}', [ViewerRecruitmentController::class, 'show'])->name('viewer.recruitments.show');
Route::get('/contact', [ViewerContactController::class, 'index'])->name('viewer.contact');
Route::post('/contact', [ViewerContactController::class, 'store'])->name('viewer.contact.store');
Route::get('/about_us', [ViewerAboutUsController::class, 'index'])->name('viewer.about_us');
Route::get('/blogs', [ViewerBlogController::class, 'index'])->name('viewer.blogs.index');
Route::get('/blogs/{slug}', [ViewerBlogController::class, 'show'])->name('viewer.blogs.show');
Route::post('/email', [ViewerEmailController::class, 'store'])->name('viewer.email.store');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware([
    'auth',
    'role:superAdmin'
])
    ->prefix('admin')
    ->group(function () {

        // User Management
        Route::get('/users', [UserController::class, 'index'])->name('admin.users');

        Route::post('/users', [UserController::class, 'store'])->name('admin.users.store');

        Route::put('/users/{user}', [UserController::class, 'update'])->name('admin.users.update');

        Route::put('/users/{user}/lock', [UserController::class, 'lock'])->name('admin.users.lock');

        Route::put('/users/{user}/unlock', [UserController::class, 'unlock'])->name('admin.users.unlock');

        Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('admin.users.destroy');
    });

Route::middleware([
    'auth',
    'role:superAdmin,admin'
])
    ->prefix('admin')
    ->group(function () {

        // Blog Category Management
        Route::get('/categories', [CategoryController::class, 'index'])->name('admin.categories');

        Route::post('/categories', [CategoryController::class, 'store'])->name('admin.categories.store');

        Route::put('/categories/{category}', [CategoryController::class, 'update'])->name('admin.categories.update');

        Route::delete('/categories/{category}', [CategoryController::class, 'destroy'])->name('admin.categories.destroy');

        // Submit Email Management
        Route::get('/submit-emails', [SubmitEmailController::class, 'index'])->name('admin.submit_emails');

         Route::post('/submit-emails', [SubmitEmailController::class, 'store'])->name('admin.submit_emails.store');

        //Route::put('/submit-emails/{submitEmail}', [SubmitEmailController::class, 'updateEmailStatus'])->name('admin.submit_emails.update_status');
        Route::delete('/submit-emails/{submitEmail}', [SubmitEmailController::class, 'destroy'])->name('admin.submit_emails.destroy');

        Route::get('/submit-emails/export', [SubmitEmailController::class, 'exportCsv'])->name('admin.submit_emails.export');


        // Submit Contact Management
        Route::get('/submit-contacts', [SubmitContactController::class, 'index'])->name('admin.submit_contacts');

        Route::post('/submit-contacts', [SubmitContactController::class, 'store'])->name('admin.submit_contacts.store');

        Route::put('/api/submit-contacts/{submitContact}/seen', [SubmitContactController::class, 'updateSeenStatus'])->name('admin.submit_contacts.update_seen');

        Route::put('/submit-contacts/{submitContact}/processing', [SubmitContactController::class, 'updateProcessingStatus'])->name('admin.submit_contacts.update_processing');

        Route::put('/submit-contacts/{submitContact}/processed', [SubmitContactController::class, 'updateProcessedStatus'])->name('admin.submit_contacts.update_processed');

        Route::delete('/submit-contacts/{submitContact}', [SubmitContactController::class, 'destroy'])->name('admin.submit_contacts.destroy');

        Route::put('/submit-contacts/{submitContact}/note', [SubmitContactController::class, 'updateNote'])->name('admin.submit_contacts.update_note');

        Route::get('/submit-contacts/export', [SubmitContactController::class, 'exportCsv'])->name('admin.submit_contacts.export');

        //Recruitment Management
        Route::get('/recruitments', [RecruitmentController::class, 'index'])->name('admin.recruitments');

        Route::post('/recruitments', [RecruitmentController::class, 'store'])->name('admin.recruitments.store');

        Route::put('/recruitments/{recruitment}', [RecruitmentController::class, 'update'])->name('admin.recruitments.update');

        Route::delete('/recruitments/{recruitment}', [RecruitmentController::class, 'destroy'])->name('admin.recruitments.destroy');

        //Service Management
        Route::get('/services', [ServiceController::class, 'index'])->name('admin.services');

        Route::post('/services', [ServiceController::class, 'store'])->name('admin.services.store');

        Route::put('/services/{service}', [ServiceController::class, 'update'])->name('admin.services.update');

        Route::put('/services/{service}/show', [ServiceController::class, 'show'])->name('admin.services.show');

        Route::put('/services/{service}/hide', [ServiceController::class, 'hide'])->name('admin.services.hide');

        Route::delete('/services/{service}', [ServiceController::class, 'destroy'])->name('admin.services.destroy');
    });

Route::middleware([
    'auth'
])
    ->prefix('admin')
    ->group(function () {

        Route::get('/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');

        // Blog Management
        Route::get('/blogs', [BlogController::class, 'index'])->name('admin.blogs');

        Route::post('/blogs', [BlogController::class, 'store'])->name('admin.blogs.store');

        Route::put('/blogs/{blog}', [BlogController::class, 'update'])->name('admin.blogs.update');

        Route::put('/blogs/{blog}/show', [BlogController::class, 'show'])->name('admin.blogs.show');

        Route::put('/blogs/{blog}/hide', [BlogController::class, 'hide'])->name('admin.blogs.hide');

        Route::delete('/blogs/{blog}', [BlogController::class, 'destroy'])->name('admin.blogs.destroy');

        // About Us Management
        Route::get('/about_us', [AboutUsController::class, 'index'])->name('admin.about_us');

        Route::post('/about_us', [AboutUsController::class, 'store'])->name('admin.about_us.store');

        Route::put('/about_us/{about_us}', [AboutUsController::class, 'update'])->name('admin.about_us.update');

        Route::delete('/about_us/{about_us}', [AboutUsController::class, 'destroy'])->name('admin.about_us.destroy');

        // CKEditor
        Route::post('/ckeditor/upload-image/{folder}', [CKEditorController::class, 'uploadImage'])->name('admin.ckeditor.upload.image');
    });

require __DIR__ . '/auth.php';
