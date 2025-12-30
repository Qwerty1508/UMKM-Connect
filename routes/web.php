<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

use App\Livewire\LandingPage;
use App\Livewire\MapExploration;
use App\Livewire\TenantStorefront;

Route::get('/', LandingPage::class)->name('home');
Route::get('/explore', MapExploration::class)->name('explore');

Route::domain('{store:slug}.' . env('APP_URL', 'localhost'))->group(function () {
    Route::get('/', TenantStorefront::class)->name('tenant.home');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
