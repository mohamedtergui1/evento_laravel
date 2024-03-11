<?php

namespace App\Repositories;

use App\Models\Event;

class EventRepository implements EventRepositoryInterface
{
    public function create(array $data)
    {
        return Event::create($data);
    }

    public function update(Event $Event, array $data)
    {
        $Event->update($data);
        return $Event;
    }

    public function delete(Event $Event)
    {
        return $Event->delete();
    }

    public function getById(int $id)
    {
        return Event::find($id);
    }
    public function getByUserId(int $id)
    {
        return Event::where("user_id", $id)->get();
    }

    public function getAll()
    {
        return Event::all();
    }
    public function paginate(int $number)
    {
        return Event::latest()->paginate($number);
    }
}
