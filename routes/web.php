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

Route::get('/', function () {
    return view('welcome');
});



Route::get('/about', [HomeController::class, 'about']);
Route::get('/events', [HomeController::class, 'events']);
Route::get('/event/{id}', [HomeController::class, 'event']);
Route::get('/category', [HomeController::class, 'category']);
Route::get('/category/{id}', [HomeController::class, 'show']);


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

require __DIR__ . '/auth.php';

// Route::any(
//     '{query}',
//     function () {
//         return view('source.404');
//     }
// )->where('query', '.*');
