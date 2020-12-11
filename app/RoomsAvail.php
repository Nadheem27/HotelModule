<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RoomsAvail extends Model
{
    protected $table = 'rooms_available';
    protected $primaryKey = 'booking_id';
    public $timestamps = false;
    protected $fillable = ['room_number','avail_date',
    'book_status','booked_by','booked_time','created_at'];
}
