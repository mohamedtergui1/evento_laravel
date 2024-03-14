<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Reservation;
use App\Repositories\ReservationRepositoryInterface;
use Illuminate\Http\Request;

class ReservationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    private $reservationRepository;

    public function __construct(ReservationRepositoryInterface $reservationRepository)
    {
        $this->reservationRepository = $reservationRepository;
    }

    function eventReservation(Event $event)
    {
        $reservation = $this->reservationRepository->getByEventId($event->id);

        return view("singlePageReservation", compact("reservation"));

    }

    /**
     * Store a newly created resource in storage.
     */
    public function getReservation(Request $request, Event $event)
    {

        $request->validate([
            "numberOfTicket" => "required|integer|min:1|max:4"
        ]);

        if ($event->rest_places >= $request->numberOfTicket) {
            if ($event->autoAccept) {
                $this->reservationRepository->create([
                    "user_id" => auth()->id()
                    ,
                    "event_id" => $event->id
                    ,
                    "status" => "accepted"
                    ,
                    "numberOfTicket" => $request->numberOfTicket
                ]);
                return redirect()->route("profile.index")->with("success", "your resirvation complete");
            } else {

                $this->reservationRepository->create([
                    "user_id" => auth()->id()
                    ,
                    "event_id" => $event->id

                    ,
                    "numberOfTicket" => $request->numberOfTicket
                ]);
                return redirect()->back()->with("success", "your reservation  complete  waiting orginazer to accept ");
            }
        } else
            return redirect()->back()->with("error", "no more places available");


    }

    /**
     * Display the specified resource.
     */
    function chnageReservationStatus(Request $request, Reservation $reservation)
    {
        $request->validate([
            "status" => "in:accepted,rejected"
        ]);

        $this->reservationRepository->update($reservation, [
            "status" => $request->status
        ]);

        return back()->with("success", "the, status {$request->status} successfuly");
    }

}
