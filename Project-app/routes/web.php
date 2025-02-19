<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ContactController; 
use App\Http\Controllers\AdminContactMessageController;
use App\Http\Controllers\CountryController;
use App\Http\Controllers\SightController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\ForumController;
use App\Http\Controllers\TopicController;
use App\Http\Controllers\ReplyController;
use App\Http\Controllers\ReviewSightsController;
use App\Http\Controllers\ProposeLocationController;
use App\Http\Controllers\UserManagementController;
use App\Http\Controllers\ProposeCountryController;
use App\Http\Controllers\AdminCountryController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\AdminTicketController;
use App\Http\Controllers\UserProfileController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\FavoriteSightsController;



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

Route::middleware(['web', 'auth', 'notBanned'])->group(function () {
    Route::get('/dashboard', function () {
        if (auth()->user()->isAdmin()) {
            return redirect()->route('admin.dashboard');
        } else {
            return view('dashboard');
        }
    })->name('dashboard');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['web', 'auth', 'admin', 'notBanned'])->group(function () {

    Route::get('/admin/dashboard', function () {
        return view('admin.dashboard');
    })->name('admin.dashboard');

    Route::get('/admin/contact-messages', [AdminContactMessageController::class, 'index'])->name('admin.contact-messages.index');
    Route::get('/admin/contact-messages/{id}', [AdminContactMessageController::class, 'show'])->name('admin.contact-messages.show');
    Route::delete('/admin/contact-messages/{message}', [AdminContactMessageController::class, 'destroy'])->name('admin.contact-messages.destroy');
});

//admin routes
Route::middleware(['auth', 'admin', 'notBanned'])->group(function () {
    //user management
    Route::get('/admin/users', [UserManagementController::class, 'index'])->name('admin.users.index');
    Route::get('/admin/users/{id}/edit', [UserManagementController::class, 'edit'])->name('admin.users.edit');
    Route::put('/admin/users/{id}', [UserManagementController::class, 'update'])->name('admin.users.update');
    //location approve
    Route::get('/admin/sights', [ReviewSightsController::class, 'index'])->name('admin.sights.index');
    Route::put('/admin/sights/{id}', [ReviewSightsController::class, 'update'])->name('admin.sights.update');
    Route::get('/admin/sights/{id}/edit', [ReviewSightsController::class, 'edit'])->name('admin.sights.edit');
    Route::get('/admin/sights/{id}', [ReviewSightsController::class, 'show'])->name('admin.sights.show');
    Route::patch('/admin/sights/{id}/approve', [ReviewSightsController::class, 'approve'])->name('admin.sights.approve');
    Route::delete('/admin/sights/{id}/decline', [ReviewSightsController::class, 'decline'])->name('admin.sights.decline');
    //countries approve
    Route::get('/admin/countries', [AdminCountryController::class, 'index'])->name('admin.countries.index');
    Route::get('/admin/countries/{id}/edit', [AdminCountryController::class, 'edit'])->name('admin.country.edit');
    Route::patch('/admin/countries/{country}', [AdminCountryController::class, 'update'])->name('admin.country.update');
    Route::patch('/admin/countries/{id}/approve', [AdminCountryController::class, 'approve'])->name('admin.country.approve');
    Route::delete('/admin/countries/{id}/decline', [AdminCountryController::class, 'decline'])->name('admin.country.decline');
    //support
    Route::get('/admin/tickets', [AdminTicketController::class, 'index'])->name('admin.tickets.index');
    Route::get('/admin/tickets/{ticket}', [AdminTicketController::class, 'show'])->name('admin.tickets.show');
    Route::patch('/admin/tickets/{ticket}/close', [AdminTicketController::class, 'close'])->name('admin.tickets.close');
    Route::post('/admin/tickets/{ticket}/reply', [AdminTicketController::class, 'reply'])->name('admin.tickets.reply');
    //article
    Route::get('/admin/articles', [ArticleController::class, 'index'])->name('articles.index');
    Route::get('/admin/articles/create', [ArticleController::class, 'create'])->name('articles.create');
    Route::get('/admin/articles/{article}/edit', [ArticleController::class, 'edit'])->name('articles.edit');
    Route::delete('/admin/articles/{article}', [ArticleController::class, 'destroy'])->name('articles.destroy');
    Route::put('/admin/articles/{article}', [ArticleController::class, 'update'])->name('articles.update');
    Route::post('/admin/articles', [ArticleController::class, 'store'])->name('articles.store');
    //report
    Route::get('/admin/reports', [ReportController::class, 'index'])->name('admin.reports.index');
    Route::get('/admin/reports/{report}', [ReportController::class, 'show'])->name('admin.reports.show');
    Route::delete('/admin/reports/{report}', [ReportController::class, 'destroy'])->name('admin.reports.destroy');
    //delete section 
    Route::delete('/admin/forum/topics/{topic}', [ForumController::class, 'destroy'])->name('admin.forum.topic.delete');
    Route::delete('/admin/forum/comments/{comment}', [ReplyController::class, 'destroy'])->name('admin.forum.comments.delete');
    Route::delete('/admin/comments/{comment}', [CommentController::class, 'destroy'])->name('admin.comments.delete');
    Route::delete('/admin/reviews/{review}', [ReviewController::class, 'destroy'])->name('admin.reviews.delete');
    Route::delete('/admin/countries/{country}', [CountryController::class, 'destroy'])->name('admin.countries.delete');
    Route::delete('/admin/sights/{sight}', [SightController::class, 'destroy'])->name('admin.sights.delete');
});



//user routes

Route::middleware(['auth' , 'notBanned'])->group(function () {
    //favourte place
    Route::get('/favorites', [FavoriteSightsController::class, 'index'])->name('favorites.index');
    Route::post('/favorites/{sight}', [FavoriteSightsController::class, 'store'])->name('favorites.store');
    Route::delete('/favorites/{sight}', [FavoriteSightsController::class, 'destroy'])->name('favorites.destroy');
    //propose country
    Route::get('/propose', [ProposeCountryController::class, 'create'])->name('countries.propose');
    Route::post('/propose', [ProposeCountryController::class, 'store'])->name('countries.store');
    //propose location
    Route::get('/locations/propose', [ProposeLocationController::class, 'create'])->name('location.propose');
    Route::post('/locations/propose', [ProposeLocationController::class, 'store'])->name('location.store');
    //forum 
    Route::get('/forum', [ForumController::class, 'index'])->name('forum.index');
    Route::get('/forum/rules', [ForumController::class, 'rules'])->name('forum.rules');
    Route::get('/forum/create', [ForumController::class, 'create'])->name('forum.create');
    Route::post('/forum', [ForumController::class, 'store'])->name('forum.store');
    Route::get('/forum/{id}', [ForumController::class, 'show'])->name('forum.show');
    Route::post('/forum/{id}/reply', [ReplyController::class, 'store'])->name('forum.reply');
    Route::delete('/forum/replies/{id}', [ReplyController::class, 'destroy'])->name('forum.reply.delete');
    //reviews
    Route::post('/reviews', [ReviewController::class, 'store'])->name('reviews.store');
    Route::delete('/reviews/{id}', [ReviewController::class, 'destroy'])->name('reviews.delete');
    //report
    Route::post('/report', [ReportController::class, 'store'])->name('reports.store');
    //comments under article
    Route::post('/articles/{article}/comments', [CommentController::class, 'store'])->name('comments.store');
    Route::delete('/comments/{comment}', [CommentController::class, 'destroy'])->name('comments.delete');
});


//support via prefix
Route::middleware('auth' ,'notBanned')->group(function () {
    Route::prefix('support')->group(function () {
        Route::get('/', [TicketController::class, 'index'])->name('support.index'); // List tickets
        Route::get('/create', [TicketController::class, 'create'])->name('support.create'); // Create ticket form
        Route::post('/', [TicketController::class, 'store'])->name('support.store'); // Store ticket
        Route::get('/{ticket}', [TicketController::class, 'show'])->name('support.show'); // Show ticket details
        Route::post('/{ticket}/reply', [TicketController::class, 'reply'])->name('support.reply'); // Reply to ticket
    });
});

//public routes
Route::middleware('notBanned')->group(function () {
    Route::get('/articles', [ArticleController::class, 'list'])->name('articles.list');
    Route::get('/articles/{article}', [ArticleController::class, 'show'])->name('articles.show');
    Route::get('/countries', [CountryController::class, 'index'])->name('countries.index');
    Route::get('/countries/{country}', [CountryController::class, 'show'])->name('countries.show');
    Route::get('/sights/{sight}', [SightController::class, 'show'])->name('sights.show');
});

Route::get('/user/{username}', [UserProfileController::class, 'show'])->name('user.profile');

require __DIR__.'/auth.php';
