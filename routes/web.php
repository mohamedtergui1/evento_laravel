<?php

use App\Http\Controllers\EventController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SocialiteController;
use App\Http\Controllers\UserController;
use App\Models\Category;
use App\Models\Event;

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
    $categories = Category::all();
    $events = Event::where("status","accepted");
    return view('welcome',compact("events","categories"));
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

# Socialite URLs

// La page où on présente les liens de redirection vers les providers


Route::get("/redirect/{provider}", [SocialiteController::class,"redirect"])->name('socialite.redirect');

Route::get("/callback/{provider}", [SocialiteController::class,"callback"])->name('socialite.callback');


Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::resources(['users' => UserController::class]);
    Route::resources(['events' => EventController::class]);
});



require __DIR__.'/auth.php';
