<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ContactController; // Replace with your actual controller
use App\Http\Controllers\AdminContactMessageController;
use App\Http\Controllers\CountryController;
use App\Http\Controllers\SightController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\ForumController;
use App\Http\Controllers\TopicController;
use App\Http\Controllers\ReplyController;



Route::get('/', function () {
    return view('home');
})->name('home');

Route::get('/about', function () {
    return view('about');
})->name('about');

Route::get('/contact', function () {
    return view('contact');
})->name('contact');

Route::post('/contact', [ContactController::class, 'submit'])->name('contact.submit');

Route::middleware(['web', 'auth'])->group(function () {
    // Dashboard Route
    Route::get('/dashboard', function () {
        if (auth()->user()->isAdmin()) {
            return redirect()->route('admin.dashboard');
        } else {
            return view('dashboard');
        }
    })->name('dashboard');

    // Profile Routes
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['web', 'auth', 'admin'])->group(function () {
    // Admin Dashboard Route
    Route::get('/admin/dashboard', function () {
        return view('admin.dashboard');
    })->name('admin.dashboard');

    // Admin Contact Message Routes
    Route::get('/admin/contact-messages', [AdminContactMessageController::class, 'index'])->name('admin.contact-messages.index');
    Route::delete('/admin/contact-messages/{message}', [AdminContactMessageController::class, 'destroy'])->name('admin.contact-messages.destroy');
});

Route::get('/countries', [CountryController::class, 'index'])->name('countries.index');
Route::get('/countries/{country}', [CountryController::class, 'show'])->name('countries.show');
Route::get('/sights/{sight}', [SightController::class, 'show'])->name('sights.show');

Route::post('/reviews', [ReviewController::class, 'store'])->middleware('auth')->name('reviews.store');

Route::get('/forum', [ForumController::class, 'index'])->name('forum.index');

Route::middleware(['auth'])->group(function () {
    Route::get('/forum', [ForumController::class, 'index'])->name('forum.index');
    Route::get('/forum/create', [ForumController::class, 'create'])->name('forum.create');
    Route::post('/forum', [ForumController::class, 'store'])->name('forum.store');
    Route::get('/forum/{id}', [ForumController::class, 'show'])->name('forum.show');
    Route::post('/forum/{id}/reply', [ReplyController::class, 'store'])->name('forum.reply');
});

require __DIR__.'/auth.php';
