<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\SearchController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SocialiteController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\UserController;
use App\Models\Category;
use App\Models\Event;
use App\Models\Ticket;
use App\Models\User;

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
    $events = Event::where("status", "accepted")->latest()->paginate(6);

    return view('welcome', compact("events", "categories"));
});


Route::middleware('auth')->group(function () {

    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');
    Route::post("/getReservation/{event}", [ReservationController::class, 'getReservation'])->name("getReservation");

    Route::resources(['events' => EventController::class]);
    Route::get("/eventReservation/{event}", [ReservationController::class, 'eventReservation'])->name("eventReservation");

    Route::put("/chnageReservationStatus/{reservation}", [ReservationController::class, 'chnageReservationStatus'])->name("chnageReservationStatus");
    Route::post("/EVENTPayment", [PaymentController::class, 'preparePayment'])->name("checkout");
    Route::get("/paymentSuccess", [PaymentController::class, 'paymentSuccess'])->name("payment.success");
    Route::get("/generateTicket/{reservation}", [TicketController::class, 'generateTicket'])->name("generateTicket");





});



Route::get("/redirect/{provider}", [SocialiteController::class, "redirect"])->name('socialite.redirect');

Route::get("/callback/{provider}", [SocialiteController::class, "callback"])->name('socialite.callback');


Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::resources(['users' => UserController::class]);
    Route::put('events/status/{event}', [EventController::class, "changeStatus"])->name("changeStatus");
    Route::put('events/status/{event}', [EventController::class, "changeStatus"])->name("changeStatus");
    Route::get('Admin/events', [EventController::class, "adminIndex"])->name("AdminIndex");
    Route::put('changeUserStatus/{user}', [UserController::class, "changeUserStatus"])->name("changeUserStatus");

    Route::get('/dashboard', function () {
        $userCount =User::Count();
        $eventCount =Event::Count();
        $categoryCount =Category::Count();

        return view('dashboard',compact("userCount","eventCount","categoryCount"));
    })->name('dashboard');

    Route::resources(['categories' => CategoryController::class]);
});

Route::get("event/{id}",[EventController::class,"show"])->name("events.read");

Route::get("/search", [SearchController::class, "search"]);
// Route::get("/moreData", [SearchController::class, "moreData"]);

require __DIR__ . '/auth.php';
