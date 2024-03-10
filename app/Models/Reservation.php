<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    use HasFactory;
    protected $fillable = [
        "user_id"
        ,
        "status"
        ,
        "event_id"
        ,
        "numberOfTicket"
    ];
    function tickets()
    {
        return $this->hasMany(Ticket::class);
    }
    function user()
    {
        return $this->belongsTo(User::class,"user_id");
    }
    function event()
    {
        return $this->belongsTo(Event::class,"event_id");
    }
}

