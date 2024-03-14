<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    //
    function search(Request $request)
    {
        if ($request->category && $request->startDate && $request->endDate) {
            $events = Event::with("user", "category")->where("title", "like", '%' . $request->search_string . '%')->Where("category_id", $request->category)->where("status", "accepted")->whereDate('date', '>=', $request->startDate)
                ->whereDate('date', '<=', $request->endDate)->latest()->paginate(6);
        } else if ($request->startDate && $request->endDate) {

            $events = Event::with("user", "category")->where("title", "like", '%' . $request->search_string . '%')
                ->whereDate('date', '>=', $request->startDate)
                ->whereDate('date', '<=', $request->endDate)->where("status", "accepted")->latest()->paginate(6);
                
        } else if ($request->category) {

            $events = Event::with("user", "category")->where("title", "like", '%' . $request->search_string . '%')->Where("category_id", $request->category)->where("status", "accepted")->latest()->paginate(6);

        } else
            $events = Event::with("user", "category")->where("title", "like", '%' . $request->search_string . '%')->where("status", "accepted")
                ->latest()->paginate(6);

        if ($events->count())
            return response()->json([
                "status" => true
                ,
                "events" => $events
                ,
                "token" => $request->header("X-CSRF-TOKEN")
            ]);
        else
            return response()->json([
                "status" => false
            ]);
    }

}
