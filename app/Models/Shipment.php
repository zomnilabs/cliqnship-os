<?php

namespace App\Models;

use App\ShipmentEvent;
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
        return $this->belongsTo(UserAddressbook::class, 'to');
    }

    public function senderAddress()
    {
        return $this->belongsTo(UserAddressbook::class, 'from');
    }

    public function source()
    {
        return $this->belongsTo(Source::class);
    }

    public function trackingNumbers()
    {
        return $this->hasMany(ShipmentTrackingNumber::class);
    }

    public function rider()
    {
        return $this->hasOne(ShipmentAssignment::class, 'shipment_id');
    }

    public function events()
    {
        return $this->hasMany(ShipmentEvent::class);
    }
}
