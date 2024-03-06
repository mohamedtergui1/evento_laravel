<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    //
    function  search(Request $request){
     if($request->category){
        $events = Event::where("title","like",'%'.$request->search_string.'%')->Where("category_id",$request->category)->where("status","accepted");

    }else $events = Event::where("title","like",'%'.$request->search_string.'%')->where("status","accepted");

    if($events->count()) return response()->json([
        "status" => true
        ,
        "events" => $events
    ]);
    else  return response()->json([
        "status" => false
    ]);
    }
}
