<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RoomsAvail extends Model
{
    protected $table = 'rooms_available';
    protected $primaryKey = 'booking_id';
    public $timestamps = false;
    protected $fillable = ['room_number','check_in',
    'book_status','check_out','created_at'];
}
