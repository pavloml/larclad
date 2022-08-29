<?php

use App\Http\Controllers\AdminBanController;
use App\Http\Controllers\AdminCategoryController;
use App\Http\Controllers\AdminCityController;
use App\Http\Controllers\AdminComplainController;
use App\Http\Controllers\AdminConfigController;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\AdminSubcategoryController;
use App\Http\Controllers\AdminUserController;
use App\Http\Controllers\ContactFormController;
use App\Http\Controllers\EmailVerificationController;
use App\Http\Controllers\EmailController;
use App\Http\Controllers\ForgotPasswordController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\PasswordController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\ResetPasswordController;
use App\Http\Controllers\SessionsController;
use App\Http\Controllers\UserActivityController;
use Illuminate\Support\Facades\Route;

Route::get('/', [PostController::class, 'index'])->name('home');
//Route::get('/search', [PostController::class, 'search_old'])->name('post.search_old');

Route::get('/search/{city}/{category}/{subcategory?}', [PostController::class, 'search'])->name('post.search');

Route::get('/post/{id}/{slug?}', [PostController::class, 'show'])->name('post.show');

// Session routes
Route::get('/login', [SessionsController::class, 'create'])->middleware('guest')->name('login');
Route::post('/login', [SessionsController::class, 'store'])->middleware('guest');
Route::delete('/logout', [SessionsController::class, 'destroy'])->middleware('auth');

// Password recovery routes
Route::get('/forgot_password', [ForgotPasswordController::class, 'create'])->middleware('guest')
    ->name('forgot.password.create');
Route::post('/forgot_password', [ForgotPasswordController::class, 'store'])->middleware('guest');
Route::get('/reset_password', [ResetPasswordController::class, 'create'])
    ->middleware('guest')->name('password.reset');
Route::post('/reset_password', [ResetPasswordController::class, 'store'])
    ->middleware('guest');

// User registration routes
Route::get('/register', [RegisterController::class, 'create'])->middleware('guest')->name('register');
Route::post('/register', [RegisterController::class, 'store'])->middleware('guest');

// Email verification routes
Route::get('/email/verify', [EmailVerificationController::class, 'notify'])
    ->middleware('auth')->name('verification.notice');
Route::get('/email/verify/{id}/{hash}', [EmailVerificationController::class, 'store'])
    ->middleware(['auth', 'signed'])->name('verification.verify');
Route::post('/email/verification-notification', [EmailVerificationController::class, 'create'])
    ->middleware(['auth', 'throttle:6,1'])->name('verification.send');

// Post manipulation routes
Route::group(['middleware' => ['auth', 'not.banned', 'verified']], function () {
    Route::get('/create_post', [PostController::class, 'create'])->name('post.create');
    Route::post('/create_post', [PostController::class, 'store']);
    Route::get('/post/edit/{id}', [PostController::class, 'edit']);
    Route::patch('/post/{id}', [PostController::class, 'update'])->name('post.update');
    Route::delete('/post/{id}', [PostController::class, 'destroy']);
});

// Profile routes
Route::group(['prefix' => 'profile', 'middleware' => ['auth', 'not.banned']], function () {
    Route::redirect('/', '/profile/posts')->name('profile');

    Route::group(['prefix' => 'posts'], function () {
        Route::get('/', [ProfileController::class, 'showActivePosts'])->name('profile.posts.active');
        Route::get('/inactive', [ProfileController::class, 'showInactivePosts'])
            ->name('profile.posts.inactive');
    });

    Route::group(['prefix' => 'messages'], function () {
        Route::get('/', [MessageController::class, 'showThreads'])->name('profile.messages.threads');
        Route::get('/conversation/{thread_id}', [MessageController::class, 'showThread'])
            ->where(['thread_id' => '[0-9]+'])
            ->name('profile.messages.thread');
        Route::post('/send_message/{post_id}/{thread_id?}', [MessageController::class, 'store'])
            ->where(['post_id' => '[0-9]+', 'thread_id' => '[0-9]+'])->name('profile.message.store');
    });

    Route::group(['prefix' => 'settings'], function () {
        Route::get('/', [ProfileController::class, 'edit'])->name('profile.settings');
        Route::patch('/', [ProfileController::class, 'update']);
        Route::get('/change_password', [PasswordController::class, 'edit'])->name('profile.password.edit');
        Route::patch('/change_password', [PasswordController::class, 'update'])->name('profile.password.store');
        Route::get('/change_email', [EmailController::class, 'edit'])->name('profile.email.edit');
        Route::patch('/change_email', [EmailController::class, 'update'])->name('profile.email.store');
        Route::get('/activity_log', [UserActivityController::class, 'show'])->name('profile.activity.show');
    });
});

// Admin Routes
Route::group(['prefix' => 'admin', 'middleware' => 'admin'], function () {
    Route::get('/', [AdminDashboardController::class, 'index'])->name('admin');

    Route::get('/users', [AdminUserController::class, 'index'])->name('admin.users');
    Route::get('/user/{id}/edit', [AdminUserController::class, 'edit'])->name('admin.users.edit');
    Route::patch('/user/{id}', [AdminUserController::class, 'update'])->name('admin.users.update');
    Route::delete('/user/{id}', [AdminUserController::class, 'destroy'])->name('admin.users.delete');

    Route::get('/bans', [AdminBanController::class, 'index'])->name('admin.bans');
    Route::get('/bans/create/{user_id}', [AdminBanController::class, 'create'])
        ->where(['user_id' => '[0-9]+'])->name('admin.bans.create');
    Route::post('/bans/create/{user_id}', [AdminBanController::class, 'store'])
        ->where(['user_id' => '[0-9]+'])->name('admin.bans.store');

    Route::get('/bans/{id}/edit', [AdminBanController::class, 'edit'])->name('admin.bans.edit');
    Route::patch('/bans/{id}', [AdminBanController::class, 'update'])->name('admin.bans.update');
    Route::delete('/bans/{id}', [AdminBanController::class, 'destroy'])->name('admin.bans.delete');

    Route::get('/complains', [AdminComplainController::class, 'index'])->name('admin.complains');
    Route::patch('/complains', [AdminComplainController::class, 'markReviewedAll'])
        ->name('admin.complains.mark_reviewed_all');
    Route::patch('/complains/{id}', [AdminComplainController::class, 'markReviewed'])->name('admin.complains.mark_reviewed');
    Route::delete('/complains/{id}', [AdminComplainController::class, 'destroy'])->name('admin.complains.delete');

    Route::get('/categories', [AdminCategoryController::class, 'index'])->name('admin.categories');
    Route::get('/categories/create', [AdminCategoryController::class, 'create'])->name('admin.categories.create');
    Route::post('/categories/create', [AdminCategoryController::class, 'store'])->name('admin.categories.store');
    Route::get('/categories/{id}/edit', [AdminCategoryController::class, 'edit'])->name('admin.categories.edit');
    Route::patch('/categories/{id}', [AdminCategoryController::class, 'update'])->name('admin.categories.update');
    Route::delete('/categories/{id}', [AdminCategoryController::class, 'destroy'])->name('admin.categories.delete');

    Route::get('/subcategories/create/{category_id}', [AdminSubcategoryController::class, 'create'])
        ->where(['category_id' => '[0-9]+'])->name('admin.subcategories.create');;
    Route::post('/subcategories/create/{category_id}', [AdminSubcategoryController::class, 'store'])
        ->where(['category_id' => '[0-9]+'])->name('admin.subcategories.store');
    Route::get('/subcategories/{id}/edit', [AdminSubcategoryController::class, 'edit'])->name('admin.subcategories.edit');
    Route::patch('/subcategories/{id}', [AdminSubcategoryController::class, 'update'])->name('admin.subcategories.update');
    Route::delete('/subcategories/{id}', [AdminSubcategoryController::class, 'destroy'])->name('admin.subcategories.delete');

    Route::get('/cities', [AdminCityController::class, 'index'])->name('admin.cities');
    Route::get('/cities/create', [AdminCityController::class, 'create'])->name('admin.cities.create');
    Route::post('/cities/create', [AdminCityController::class, 'store'])->name('admin.cities.store');
    Route::get('/cities/{id}/edit', [AdminCityController::class, 'edit'])->name('admin.cities.edit');
    Route::patch('/cities/{id}', [AdminCityController::class, 'update'])->name('admin.cities.update');
    Route::delete('/cities/{id}', [AdminCityController::class, 'destroy'])->name('admin.cities.delete');

});

// Static routes
Route::view('/about', 'static.about')->name('static.about');
Route::view('/faq', 'static.faq')->name('static.faq');
Route::view('/privacy', 'static.privacy')->name('static.privacy');
Route::view('/help', 'static.help')->name('static.help');
//Route::view('/safety', 'static.safety')->name('static.safety');
Route::view('/contact', 'static.contact')->name('static.contact');
Route::view('/terms', 'static.terms')->name('static.terms');

Route::post('/contact', [ContactFormController::class, 'store']);

Route::fallback(fn() => response(view('errors.404'), 404));
