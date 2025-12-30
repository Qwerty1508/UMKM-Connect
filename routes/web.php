<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

use App\Livewire\LandingPage;
use App\Livewire\MapExploration;
use App\Livewire\TenantStorefront;
use App\Livewire\RealtimeChat;
use App\Livewire\Checkout;
use App\Livewire\OrderTracking;
use App\Livewire\OrderHistory;
use App\Livewire\SellerRegistration;

Route::get('/', LandingPage::class)->name('home');
Route::get('/explore', MapExploration::class)->name('explore');
Route::get('/chat', RealtimeChat::class)->name('chat');
Route::get('/checkout', Checkout::class)->name('checkout');
Route::get('/orders', OrderHistory::class)->name('orders.index');
use App\Livewire\SellerDashboard;
use App\Livewire\ProductManager;
use App\Livewire\SalesReports;
use App\Livewire\AdminDashboard;
use App\Livewire\UserManagement;
use App\Livewire\SystemConfiguration;
use App\Livewire\HelpCenter;

Route::get('/orders/{order}', OrderTracking::class)->name('orders.show');
Route::get('/register-umkm', SellerRegistration::class)->name('seller.register');
Route::get('/seller/dashboard', SellerDashboard::class)->name('seller.dashboard');
Route::get('/seller/products', ProductManager::class)->name('seller.products');
Route::get('/seller/reports', SalesReports::class)->name('seller.reports');
Route::get('/admin/dashboard', AdminDashboard::class)->name('admin.dashboard');
Route::get('/admin/users', UserManagement::class)->name('admin.users');
Route::get('/admin/settings', SystemConfiguration::class)->name('admin.settings');
Route::get('/help', HelpCenter::class)->name('help');

Route::domain('{store:slug}.' . env('APP_URL', 'localhost'))->group(function () {
    Route::get('/', TenantStorefront::class)->name('tenant.home');
});

Route::view('/dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
