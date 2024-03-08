<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\SearchController;
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
    $events = Event::where("status", "accepted")->paginate(10);

    return view('welcome', compact("events", "categories"));
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');
Route::middleware('auth')->group(function () {

    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');
    Route::post("/getReservation/{event}", [ReservationController::class, 'getReservation'])->name("getReservation");

    Route::resources(['events' => EventController::class]);
    Route::get("/eventReservation/{event}", [ReservationController::class, 'eventReservation'])->name("eventReservation");

    Route::get("/chnageReservationStatus/{reservation}", [ReservationController::class, 'chnageReservationStatus'])->name("chnageReservationStatus");



});

 

Route::get("/redirect/{provider}", [SocialiteController::class, "redirect"])->name('socialite.redirect');

Route::get("/callback/{provider}", [SocialiteController::class, "callback"])->name('socialite.callback');


Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::resources(['users' => UserController::class]);
    Route::put('events/status/{event}', [EventController::class, "changeStatus"])->name("changeStatus");
    Route::put('events/status/{event}', [EventController::class, "changeStatus"])->name("changeStatus");
    Route::get('Admin/events', [EventController::class, "adminIndex"])->name("AdminIndex");

    Route::resources(['categories' => CategoryController::class]);
});



Route::get("/search", [SearchController::class, "search"]);

require __DIR__ . '/auth.php';
