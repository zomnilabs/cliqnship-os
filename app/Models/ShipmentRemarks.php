<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ShipmentRemarks extends Model
{
    protected $guarded = ['id'];

    public function shipment() {
        return $this->belongsTo(Shipment::class);
    }
}
