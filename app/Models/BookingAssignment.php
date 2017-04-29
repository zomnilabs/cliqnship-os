<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BookingAssignment extends Model
{
    use SoftDeletes;

    protected $guarded = ['id'];

    public function booking()
    {
        return $this->belongsTo(Booking::class, 'booking_id');
    }

    public function rider()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
