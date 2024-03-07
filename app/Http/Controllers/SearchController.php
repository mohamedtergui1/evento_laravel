<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    //
    function  search(Request $request){
     if($request->category){
        $events = Event::with("user","category")->where("title","like",'%'.$request->search_string.'%')->Where("category_id",$request->category)->where("status","accepted")->get();

    }else $events = Event::with("user","category")->where("title","like",'%'.$request->search_string.'%')->where("status","accepted")->get();

    if($events->count()) return response()->json([
        "status" => true
        ,
        "events" => $events
        ,
        "token"  => $request->header("X-CSRF-TOKEN")
    ]);
    else  return response()->json([
        "status" => false
    ]);
    }
}
