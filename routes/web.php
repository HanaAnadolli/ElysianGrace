<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\FruitController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\CommentController;
use App\Http\Controllers\Admin\SliderController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\RoomController;
use App\Http\Controllers\Admin\ServiceController;
use App\Http\Controllers\Admin\ContactFormController;
use App\Http\Controllers\User\UserDashboardController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

// Profile routes for authenticated users
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Admin route group
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    // Add more admin routes here if needed

    Route::resource('fruits', FruitController::class);
    Route::resource('category', CategoryController::class);
    Route::put('category/change-status', [CategoryController::class, 'changeStatus'])->name('category.change-status');
    Route::resource('comments', CommentController::class);
    Route::resource('slider', SliderController::class);
    Route::put('slider/change-status', [SliderController::class, 'changeStatus'])->name('slider.change-status');
    Route::resource('rooms', RoomController::class);
    Route::put('rooms/change-status', [RoomController::class, 'changeStatus'])->name('rooms.change-status');
    Route::resource('services', ServiceController::class);
    Route::put('services/change-status', [ServiceController::class, 'changeStatus'])->name('services.change-status');
    Route::resource('contact_forms', ContactFormController::class);
    Route::patch('contact_forms/{id}/mark-as-read', [ContactFormController::class, 'markAsRead'])->name('contact_forms.markAsRead');
});

// User route group
Route::middleware(['auth', 'role:user'])->group(function () {
    Route::get('/user/dashboard', [UserDashboardController::class, 'index'])->name('user.dashboard');
    // Add more user routes here if needed
});

// Auth routes
require __DIR__.'/auth.php';
