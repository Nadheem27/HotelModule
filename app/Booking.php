<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    protected $table = 'booked_rooms';
    protected $primaryKey = 'book_room_id';
    public $timestamps = false;
    protected $fillable = ['booking_id','room_number','booked_dates','created_at'];
}
