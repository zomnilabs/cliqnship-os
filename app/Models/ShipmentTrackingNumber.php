<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ShipmentTrackingNumber extends Model
{
    use SoftDeletes;

    protected $guarded = ['id'];

    public function shipment()
    {
        return $this->belongsTo(Shipment::class);
    }

    public function scopeMainTrackingNumber($query)
    {
        return $query->where('provider', 'cliqnship')
            ->first();
    }
}
