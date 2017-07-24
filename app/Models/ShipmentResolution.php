<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ShipmentResolution extends Model
{
    protected $table = 'shipment_resolutions';
    protected $guarded = ['id'];

    public function shipment() {
        return $this->belongsTo(Shipment::class);
    }

    public function logs() {
        return $this->hasMany(ShipmentReturnLogs::class);
    }
}
