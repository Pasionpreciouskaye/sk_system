<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    BudgetCategoryController,
    InventoryCategoryController,
    DashboardController,
    UserController,
    BudgetController,
    InventoryController,
    ProjectController,
    EventController,
    FeedbackController,
    Auth\LoginController,
    Auth\ForgotPasswordController,
    Auth\ResetPasswordController
};

// ---------- Public Pages ----------
Route::get('/', fn() => view('welcome'))->name('home');
Route::get('/contact-us', fn() => view('contact'))->name('contact');

Route::get('/project-show', [ProjectController::class, 'projectShow'])->name('project');
Route::get('/event-show', [EventController::class, 'eventShow'])->name('event');
Route::get('/budget-show', [BudgetController::class, 'budgetShow'])->name('budget');
Route::get('/inventory-show', [InventoryController::class, 'inventoryShow'])->name('inventory');

// ---------- Auth Routes ----------
Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login/authenticate', [LoginController::class, 'authenticate'])->name('authenticate');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('forgot-password', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
Route::post('forgot-password', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
Route::get('reset-password/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');
Route::post('reset-password', [ResetPasswordController::class, 'reset'])->name('password.update');

// ---------- Event Registration (Public) ----------
Route::post('/event/{event}/register', [EventController::class, 'eventRegistration'])->name('event.registration');

// ---------- Feedback (Public or Authenticated) ----------
Route::resource('feedback', FeedbackController::class)->only(['index', 'store', 'destroy']);

// ---------- Authenticated/Admin Routes ----------
Route::middleware(['auth'])->group(function () {
    // Dashboard and Profile
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/profile', [UserController::class, 'profile'])->name('profile.index');
    Route::put('/profile/{user}', [UserController::class, 'updateProfile'])->name('profile.update');

    // Resources
    Route::resource('user', UserController::class);
    Route::resource('budget', BudgetController::class);
    Route::resource('inventory', InventoryController::class);
    Route::resource('project', ProjectController::class);
    Route::resource('event', EventController::class);
    Route::resource('budget_category', BudgetCategoryController::class);
    Route::resource('inventory_category', InventoryCategoryController::class);
});
