<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Event extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'description',
        'date',
        'category_id',
        'organizer_id',
        'status',
        'price',
        'location',
        'autoAccept',
        'capacity',
        'rest_places',
        "image"
    ];
    function category()
    {
        return $this->belongsTo(Category::class,"category_id");
    }
    function user(){
        return $this->belongsTo(User::class,"organizer_id");
    }
    function allUsersTakeReservation(){
        return $this->belongsToMany(User::class,"reservation");
    }
    function reservations(){
        return $this->hasMany(Reservation::class);
    }

}
