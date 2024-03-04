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
        'autoAkcept'
    ];
    function category()
    {
        return $this->belongsTo(Category::class);
    }
    function user(){
        return $this->belongsTo(User::class);
    }
    function allUsersTakeReservation(){
        return $this->belongsToMany(User::class,"reservation");
    }
    function reservation(){
        return $this->hasMany(Reservation::class);
    }

}
