<?php

use App\Livewire\Admin\Orders\OrderManagement;
use App\Livewire\Admin\Dashboard;
use App\Livewire\Admin\Users\Index;

Route::prefix('admin')->name('admin.')->middleware(['auth', 'admin'])->group(function () {
    Route::get('/dashboard', Dashboard::class)->name('dashboard');
    Route::get('/users', Index::class)->name('users.index');
    Route::get('/orders', OrderManagement::class)->name('orders.index');
});