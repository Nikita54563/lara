<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Middleware\EnsureUserIsAdmin;

Route::get('/admin/login', [AdminController::class, 'showLoginForm'])->name('admin.login');
Route::post('/admin/login', [AdminController::class, 'login']);

// Маршрут для выхода
Route::post('/admin/logout', [AdminController::class, 'logout'])->name('admin.logout');

// Маршрут для просмотра списка пользователей (только для администраторов)
Route::middleware(EnsureUserIsAdmin::class)->group(function () {
    Route::get('/admin/users', [AdminController::class, 'index'])->name('admin.users.index');
});


// Маршрут для отображения формы создания нового пользователя
Route::get('/admin/users/create', [AdminController::class, 'create'])->name('admin.users.create');

// Маршрут для обработки запроса на создание пользователя
Route::post('/admin/users', [AdminController::class, 'store'])->name('admin.users.store');

// Маршрут для удаления пользователя
Route::delete('/admin/users/{user}', [AdminController::class, 'destroy'])->name('admin.users.destroy');



Route::get('/', function () {
    return redirect()->route('login');
});


Route::middleware(['auth'])->get('/redi', function () {
    return redirect('http://localhost:3000'); // URL React-приложения
})->name('dashboard');


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
