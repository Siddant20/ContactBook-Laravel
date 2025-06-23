<?php

use App\Http\Controllers\ContactController;
use App\Livewire\Settings\Appearance;
use App\Livewire\Settings\Password;
use App\Livewire\Settings\Profile;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;

Route::get('/', [ContactController::class, 'index'])->name('home')->middleware('auth');


Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');

    Route::get('settings/profile', Profile::class)->name('settings.profile');
    Route::get('settings/password', Password::class)->name('settings.password');
    Route::get('settings/appearance', Appearance::class)->name('settings.appearance');
    Route::resource('contacts', ContactController::class);
    
    // 
});

Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin/users', [AdminController::class, 'index'])->name('admin.users');
    Route::post('/admin/users/{user}/make-admin', [AdminController::class, 'makeAdmin'])->name('admin.users.makeAdmin');
    Route::resource('admin', AdminController::class);
    Route::post('/admin/user/{user}/remove-admin',[AdminController::class,'removeAdmin'])->name('admin.users.removeAdmin');
    Route::get('/admin/user/{user}/contacts', [AdminController::class,'show'])->name('admin.users.show');
});

require __DIR__.'/auth.php';
