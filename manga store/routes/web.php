<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MangaController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\FuncionarioController;

Route::get('/', function () {
    return view('auth/login');
});

Route::middleware(['auth', 'role:admin,funcionario'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Mangas and Clientes - Admin and Funcionario
    Route::resource('mangas', MangaController::class);
    Route::resource('clientes', ClienteController::class);

    // Funcionarios - Admin only
    Route::middleware('role:admin')->resource('funcionarios', FuncionarioController::class);
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
