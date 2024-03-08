<?php

namespace App\Repositories;

use App\Models\Reservation;

class ReservationRepository implements ReservationRepositoryInterface
{
    public function create(array $data)
    {
        return Reservation::create($data);
    }

    public function update(Reservation $Reservation, array $data)
    {
        $Reservation->update($data);
        return $Reservation;
    }

    public function delete(Reservation $Reservation)
    {
        return $Reservation->delete();
    }
    public function  getByEventId(int $id){
        return Reservation::with("user")->where("event_id",$id)->where("status","pending")->get();
    }

    public function getById(int $id)
    {
        return Reservation::find($id);
    }
    public function getByUserId(int $id)
    {
        return Reservation::where("user_id", $id)->get();
    }

    public function getAll()
    {
        return Reservation::all();
    }
    public function paginate(int $number)
    {
        return Reservation::paginate($number);
    }
}
