<?php

namespace App\Repositories;

use App\Models\Reservation;

interface ReservationRepositoryInterface
{
    public function create(array $data);

    public function update(Reservation $Reservation, array $data);

    public function delete(Reservation $Reservation);

    public function getById(int $id);

    public function getByUserId(int $id);
    public function getByEventId(int $id);

    public function getAll();
    public function paginate(int $number);

}
