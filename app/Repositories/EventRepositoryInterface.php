<?php

namespace App\Repositories;

use App\Models\Event;

interface EventRepositoryInterface
{
    public function create(array $data);

    public function update(Event $event, array $data);

    public function delete(Event $event);

    public function getById(int $id);

    public function getByUserId(int $id);

    public function getAll();
    public function paginate(int $number);

}
