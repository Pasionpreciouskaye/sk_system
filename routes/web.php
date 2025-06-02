<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BudgetCategoryController;
use App\Http\Controllers\InventoryCategoryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\BudgetController;
use App\Http\Controllers\InventoryController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\FeedbackController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::get('/contact-us', function () {
    return view('contact');
})->name('contact');

Route::get('/test-chart', function () {
    return view('test-chart');
})->name('test-chart');

Route::get('/project-show', [ProjectController::class, 'projectShow'])->name('project');
Route::get('/event-show', [EventController::class, 'eventShow'])->name('event');
Route::get('/budget-show', [BudgetController::class, 'budgetShow'])->name('budget');
Route::get('/inventory-show', [InventoryController::class, 'inventoryShow'])->name('inventory');
Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login/authenticate', [LoginController::class, 'authenticate'])->name('authenticate');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
Route::get('forgot-password', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
Route::post('forgot-password', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
Route::get('reset-password/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');
Route::post('reset-password', [ResetPasswordController::class, 'reset'])->name('password.update');
Route::post('/event-registration/{event}', [EventController::class, 'eventRegistration'])->name('event.registration');


Route::resource('feedback', FeedbackController::class);

Route::middleware(['auth'])
    ->group(function() {
        Route::resource('budget_category', BudgetCategoryController::class);
        Route::resource('inventory_category', InventoryCategoryController::class);
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
        Route::resource('user', UserController::class);
        Route::resource('budget', BudgetController::class);
        Route::resource('inventory', InventoryController::class);
        Route::resource('project', ProjectController::class);
        Route::resource('event', EventController::class);
    });