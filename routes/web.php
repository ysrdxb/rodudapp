<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Livewire\Admin\Dashboard;
use App\Livewire\Admin\Users\Index;
use App\Livewire\User\OrderManagement;
use App\Http\Controllers\Api\AuthController;

Livewire::setScriptRoute(function($handle) {
    return Route::get('/rodudapp/public/livewire/livewire.js', $handle);
});

Livewire::setUpdateRoute(function($handle) {
    return Route::get('/rodudapp/public/livewire/update', $handle);
});

Route::get('/', function () {
    return view('home');
});

Route::middleware(['auth', 'user'])->group(function () {

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');

    Route::get('/user/dashboard', function () {
        return view('home');
    })->name('user.dashboard');

    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/login', [AuthController::class, 'login']);
    
    Route::middleware('auth:sanctum')->group(function () {
        Route::get('/user', [AuthController::class, 'user']);
        Route::post('/logout', [AuthController::class, 'logout']);
        
        Route::get('/orders', OrderManagement::class)->name('user.orders'); 
    });
});

require __DIR__.'/auth.php';

require __DIR__.'/api.php';

require __DIR__.'/admin.php';