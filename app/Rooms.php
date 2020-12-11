<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rooms extends Model
{
    protected $table = 'rooms';
    protected $primaryKey = 'room_id';
    public $timestamps = false;
    protected $fillable = ['room_number','floor',
    'beds','record_status','created_at'];
}
