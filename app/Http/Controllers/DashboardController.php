<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Event;
use App\Models\User;

class DashboardController extends Controller
{
   function index(){

    $userCount = User::count();
    $eventCount = Event::count();
    $categoryCount = Category::count();
    $categories = Category::all();
     
    return view('dashboard', compact("userCount", "eventCount", "categoryCount", "categories"));
   }
}
