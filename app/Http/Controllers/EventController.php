<?php

namespace App\Http\Controllers;

use App\Http\Requests\EventRequest;
use App\Models\Event;
use App\Models\Category;
use App\Repositories\EventRepositoryInterface;
use Illuminate\Http\Request;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    private $eventRepository;

    public function __construct(EventRepositoryInterface $eventRepository)
    {
        $this->eventRepository = $eventRepository;
    }
    public function adminIndex()
    {
        $events = $this->eventRepository->paginate(10);
        $categories = Category::All();
        return view("admin.events.index", compact("events", "categories"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(EventRequest $request)
    {
        //

        $all = $request->all() + ["organizer_id" => auth()->user()->id];
        $event = $this->eventRepository->create($all);
        return redirect()->route("profile.index")->with("success", "event created successfuly");

    }

    /**
     * Display the specified resource.
     */
    public function show(int $id)
    {
        //

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(int $id)
    {
        //

        $event = $this->eventRepository->getById($id);
        $categories = Category::All();
        return view("admin.events.edit", compact("event", "categories"));


    }

    /**
     * Update the specified resource in storage.
     */
    public function update(EventRequest $request, Event $event)
    {
        //

        if ($request->autoAccept) {
            $event = $this->eventRepository->update($event, $request->all());



        } else {
            $all = $request->all() + ["autoAccept" => 0];
            $event = $this->eventRepository->update($event, $all);
        }
        return redirect()->route("profile.index")->with("success", "event updated successfuly");

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Event $event)
    {
        //
        $this->eventRepository->delete($event);
        return redirect()->route("profile.index")->with("success", "event deletes with success");

    }
    public function changeStatus(Request $request, Event $event)
    {



            $event = $this->eventRepository->update($event, [
                 "status" =>  $request->status ]);



         return redirect()->route("AdminIndex")->with("success", "event {$request->status}d successfuly");

    }
}
