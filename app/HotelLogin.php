<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\HotelLogin as Authenticatable;

class HotelLogin extends Authenticatable
{
    protected $table = 'hotel_login';
    protected $primaryKey = 'hotel_id';
    public $timestamps = false;
    protected $fillable = ['name','email',
    'phone_number','password','user','created_at'];
    
}
