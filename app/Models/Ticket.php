<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    protected $fillable = ['reservation_id', 'ticketCode'];

    protected static function boot()
    {
        parent::boot();

        // Generate a random code before creating a new ticket
        static::creating(function ($ticket) {
            $ticket->ticketCode = static::generateUniqueCode();
        });
    }

    // Method to generate a unique random code
    protected static function generateUniqueCode($length = 10)
    {
        $code = substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, $length);

        // Check if the generated code is unique
        if (static::where('ticketCode', $code)->exists()) {
            return static::generateUniqueCode($length);
        }

        return $code;
    }


    function reservation(){
        return $this->belongsTo(Reservation::class);
    }
}
