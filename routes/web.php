<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\HoroscopeController;
use App\Http\Controllers\CompatibilityController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\InteractiveController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\ContactController;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::post('/horoscope/personal', [HoroscopeController::class, 'calculatePersonal'])->name('horoscope.calculate');
Route::get('/horoscope', [HoroscopeController::class, 'index'])->name('horoscope');
Route::get('/horoscope/daily', [HoroscopeController::class, 'daily'])->name('horoscope.daily');
Route::get('/horoscope/weekly', [HoroscopeController::class, 'weekly'])->name('horoscope.weekly');
Route::get('/horoscope/monthly', [HoroscopeController::class, 'monthly'])->name('horoscope.monthly');
Route::get('/compatibility', [CompatibilityController::class, 'index'])->name('compatibility');
Route::post('/compatibility', [CompatibilityController::class, 'calculate'])->name('compatibility.calculate');
Route::get('/blog', [BlogController::class, 'index'])->name('blog');
Route::get('/blog/{slug}', [BlogController::class, 'show'])->name('blog.show');
Route::get('/interactive', [InteractiveController::class, 'index'])->name('interactive');
Route::get('/about', [AboutController::class, 'index'])->name('about');
Route::get('/contact', [ContactController::class, 'index'])->name('contact');
Route::post('/contact', [ContactController::class, 'send'])->name('contact.send');
Route::get('/test', function () {
    return view('test');
});
