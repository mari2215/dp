<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\ProfileController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [HomeController::class, 'home']);

Route::get('/about', [HomeController::class, 'about']);
Route::get('/events', [HomeController::class, 'events']);
Route::get('/event/{id}', [HomeController::class, 'event']);
Route::get('/category', [HomeController::class, 'category']);
Route::get('/category/{id}', [HomeController::class, 'show']);
Route::get('/activity/{id}', [HomeController::class, 'activity']);
Route::get('/search', [HomeController::class, 'search'])->name('search');


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

//Route::get('/admin', function () {
//    return view('dashboard');
//})->middleware(['auth', 'verified']);

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


Route::get('/google/redirect', [App\Http\Controllers\GoogleLoginController::class, 'redirectToGoogle'])->name('google.redirect');
Route::get('/google/callback', [App\Http\Controllers\GoogleLoginController::class, 'handleGoogleCallback'])->name('google.callback');

Route::get('/images/{folder}/{name}',         [ImageController::class, 'view']);
Route::post('/comment/{eventId}', [HomeController::class, 'storeComment']);
Route::post('/book/{eventId}', [HomeController::class, 'storeBooking']);
Route::patch('/booking/{id}/read', [HomeController::class, 'markAsRead'])->name('booking.markAsRead');

Route::delete('/comments/{id}', [HomeController::class, 'destroyComment'])->name('comments.destroy');
Route::post('/reject-booking', [HomeController::class, 'reject'])->name('bookings.reject');

Route::get('/page/{page}', [\App\Http\Controllers\PageController::class, 'index'])->name('page_index');



Route::get('/welcome/{page}/{categories}', [HomeController::class, 'welcome']);

require __DIR__ . '/auth.php';

// Route::any(
//     '{query}',
//     function () {
//         return view('source.404');
//     }
// )->where('query', '.*');
