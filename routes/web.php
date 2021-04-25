<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
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
    return view('index');
});

Auth::routes(['verify' => true]);


Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/annonce', [App\Http\Controllers\AdController::class, 'create'])->name('ad.create');
Route::get('/annonce/showAnnounce', [App\Http\Controllers\AdController::class, 'showAnnounce'])->name('ad.showAnnounce');
Route::post('/annonce/create', [App\Http\Controllers\AdController::class, 'store'])->name('ad.store');
Route::get('/annonce/delete/{id}', [App\Http\Controllers\AdController::class, 'delete'])->name('ad.delete');
Route::get('/annonce/update/{id}', [App\Http\Controllers\AdController::class, 'showAnnounceUpdate'])->name('ad.update');
Route::post('/annonce/updateAd/{id}', [App\Http\Controllers\AdController::class, 'update'])->name('ad.updateAd');

Route::get('/search', [App\Http\Controllers\AdController::class, 'search'])->name('search.display');
Route::post('/search/name', [App\Http\Controllers\AdController::class, 'searchName'])->name('search.name');
Route::post('/search/price', [App\Http\Controllers\AdController::class, 'searchPrice'])->name('search.price');
Route::post('/search/localisation', [App\Http\Controllers\AdController::class, 'searchLocalisation'])->name('search.localisation');

Route::get('/message', [App\Http\Controllers\MessageController::class, 'display'])->name('message.display');
Route::post('/message/send', [App\Http\Controllers\MessageController::class, 'store'])->name('message.store');
Route::get('/message/delete/{id}', [App\Http\Controllers\MessageController::class, 'delete'])->name('message.delete');


Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('home');
})->name('dashboard');

Route::get('/email/verify', function () {
    return view('auth.verify-email');
})->middleware('auth')->name('verification.notice');

Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();
    return redirect('/dashboard');
})->middleware(['auth', 'signed'])->name('verification.verify');

Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();

    return back()->with('message', 'Verification link sent!');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');

Route::get('/profile', function () {
    // Only verified users may access this route...
})->middleware('verified');
