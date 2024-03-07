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
    public function index()
    {
        //
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
    public function getReservation(Request $request, Event $event)
    {
        $request->validate([
            "number" => "require|min:1|max:8"
        ]);
        if ($event->autoAccept) {
            $this->reservationRepository->create([
                "user_id" => auth()->id()
                ,
                "event_id" => $event->id
                ,
                "status" => "pending"
                ,
                "numberOfTicket" => $request->numberOfTicket
            ]);
            return redirect()->back()->with("success", "your resirvation complete");
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
    }

    /**
     * Display the specified resource.
     */
    public function show(Reservation $reservation)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Reservation $reservation)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Reservation $reservation)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Reservation $reservation)
    {
        //
    }
}
