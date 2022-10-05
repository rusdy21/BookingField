<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Booking extends Model
{
    use HasFactory;

    use SoftDeletes;

    protected $fillable = [
        'id_member','id_field','time_start','time_end','id_user', 'booking_date'
    ];

    protected $hidden=[


    ];



}
