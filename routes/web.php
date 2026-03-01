<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ExerciseController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect('/login');
});

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
});

Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('/exercises/index', [ExerciseController::class, 'index'])->name('exercises.index');
    Route::get('/exercises/saved', [ExerciseController::class, 'saved'])->name('exercises.saved');
    Route::get('exercises/view/{id}', [ExerciseController::class, 'view'])->name('exercises.view');
    
    Route::get('/exercises/create', [ExerciseController::class, 'create'])->name('exercises.create');
    Route::post('/exercises', [ExerciseController::class, 'store'])->name('exercises.store');
    Route::get('/exercises/edit/{id}', [ExerciseController::class, 'edit'])->name('exercises.edit');
    Route::put('/exercises/{id}', [ExerciseController::class, 'update'])->name('exercises.update');
    Route::delete('/exercises/{id}', [ExerciseController::class, 'destroy'])->name('exercises.destroy');
    
    Route::post('/exercises/toggle-save', [ExerciseController::class, 'toggleSave'])->name('exercises.toggleSave');
    
    Route::post('/exercises/{id}/comments', [ExerciseController::class, 'addComment'])->name('exercises.comments.store');
    Route::delete('/exercises/{id}/comments', [ExerciseController::class, 'deleteComment'])->name('exercises.comments.delete');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/admin', [DashboardController::class, 'adminDashboard'])->name('admin.dashboard');
    
    Route::get('/admin/users', [DashboardController::class, 'manageUsers'])->name('admin.users');
    Route::get('/admin/users/create', [DashboardController::class, 'createUser'])->name('admin.users.create');
    Route::post('/admin/users', [DashboardController::class, 'storeUser'])->name('admin.users.store');
    Route::get('/admin/users/{id}/edit', [DashboardController::class, 'editUser'])->name('admin.users.edit');
    Route::put('/admin/users/{id}', [DashboardController::class, 'updateUser'])->name('admin.users.update');
    Route::delete('/admin/users/{id}', [DashboardController::class, 'destroyUser'])->name('admin.users.destroy');
    
    Route::get('/admin/exercises', [DashboardController::class, 'manageExercises'])->name('admin.exercises');
    Route::get('/admin/exercises/{id}/edit', [DashboardController::class, 'editAnyExercise'])->name('admin.exercises.edit');
    Route::put('/admin/exercises/{id}', [DashboardController::class, 'updateAnyExercise'])->name('admin.exercises.update');
    Route::delete('/admin/exercises/{id}', [DashboardController::class, 'destroyAnyExercise'])->name('admin.exercises.destroy');
    
    Route::get('/admin/categories', [DashboardController::class, 'manageCategories'])->name('admin.categories');
    Route::post('/admin/categories', [DashboardController::class, 'storeCategory'])->name('admin.categories.store');
    Route::delete('/admin/categories/{id}', [DashboardController::class, 'destroyCategory'])->name('admin.categories.destroy');
    
    Route::get('/admin/comments', [DashboardController::class, 'manageComments'])->name('admin.comments');
    Route::delete('/admin/comments/{id}', [DashboardController::class, 'destroyAnyComment'])->name('admin.comments.destroy');
});
