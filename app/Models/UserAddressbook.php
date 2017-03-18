<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserAddressbook extends Model
{
    use SoftDeletes;

    protected $guarded = ['id'];

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }
    public function items()
    {
        return $this->hasMany(ItemRequest::class);
    }

    public function shipments()
    {
        return $this->hasMany(Shipment::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getFullAddress()
    {
        return ucwords($this->attributes['identifier'] . ': ' . $this->attributes['address_line_1'] . ', ' . $this->attributes['barangay'] . ', ' . $this->attributes['city']);
    }

}
