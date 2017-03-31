<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Shipment extends Model
{
    use SoftDeletes;

    protected $guarded = ['id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function address()
    {
        return $this->belongsTo(UserAddressbook::class, 'user_addressbook_id');
    }

    public function source()
    {
        return $this->belongsTo(Source::class);
    }

    public function trackingNumbers()
    {
        return $this->hasMany(ShipmentTrackingNumbers::class);
    }

    public function rider()
    {
        return $this->hasOne(ShipmentAssignment::class);
    }
}
