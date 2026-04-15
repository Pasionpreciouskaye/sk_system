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
    FeedbackController,
    AuditTrailController,
    Auth\LoginController,
    Auth\ForgotPasswordController,
    Auth\ResetPasswordController
};

// ---------- Public Pages ----------
Route::get('/', fn() => view('welcome'))->name('home');
Route::get('/contact-us', fn() => view('contact'))->name('contact');

Route::get('/project-show', [ProjectController::class, 'projectShow'])->name('project');
Route::get('/budget-show', [BudgetController::class, 'budgetShow'])->name('budget');
Route::get('/inventory-show', [InventoryController::class, 'inventoryShow'])->name('inventory');

// ---------- Project Registration (Public) ----------
Route::post('/project/{project}/register', [ProjectController::class, 'register'])
    ->middleware('throttle:10,1')
    ->name('project.registration');

// ---------- Auth Routes ----------
Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login/authenticate', [LoginController::class, 'authenticate'])
    ->middleware('throttle:login')
    ->name('authenticate');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('forgot-password', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
Route::post('forgot-password', [ForgotPasswordController::class, 'sendResetLinkEmail'])
    ->middleware('throttle:5,1')
    ->name('password.email');
Route::get('reset-password/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');
Route::post('reset-password', [ResetPasswordController::class, 'reset'])
    ->middleware('throttle:5,1')
    ->name('password.update');

// ---------- Feedback (Public submit, admin manage) ----------
Route::resource('feedback', FeedbackController::class)->only(['store']);

// ---------- Authenticated/Admin Routes ----------
Route::middleware(['auth'])->group(function () {

    // ── Accessible by all authenticated admins ──
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/profile', [UserController::class, 'profile'])->name('profile.index');
    Route::put('/profile/{user}', [UserController::class, 'updateProfile'])->name('profile.update');

    // ── Super Admin only: manage users/members ──
    Route::resource('user', UserController::class)
        ->middleware('role:super_admin');

    // ── Treasurer + Super Admin: budget & inventory ──
    Route::resource('budget', BudgetController::class)
        ->middleware('role:super_admin,treasurer');
    Route::resource('budget_category', BudgetCategoryController::class)
        ->middleware('role:super_admin,treasurer');
    Route::resource('inventory', InventoryController::class)
        ->middleware('role:super_admin,treasurer');
    Route::resource('inventory_category', InventoryCategoryController::class)
        ->middleware('role:super_admin,treasurer');

    // ── Secretary + Super Admin: projects, feedback ──
    Route::resource('project', ProjectController::class)
        ->middleware('role:super_admin,secretary');

    // ── Feedback: secretary + super_admin ──
    Route::resource('feedback', FeedbackController::class)
        ->only(['index', 'destroy'])
        ->middleware('role:super_admin,secretary');

    // ── Audit Trail: super_admin only ──
    Route::get('/audit-trail', [AuditTrailController::class, 'index'])->name('audit.index');
    Route::get('/audit-trail/{auditTrail}', [AuditTrailController::class, 'show'])->name('audit.show');
});
