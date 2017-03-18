<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Booking extends Model
{
    use SoftDeletes;

    protected $guarded = ['id'];

    public function address()
    {
        return $this->belongsTo(UserAddressbook::class, 'user_addressbook_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function assignment()
    {
        return $this->hasOne(BookingAssignment::class);
    }
}
