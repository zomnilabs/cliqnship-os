<?php

namespace App\Models;

use App\Models\ShipmentResolutionMessage;
use Illuminate\Database\Eloquent\Model;

class ShipmentResolution extends Model
{
    protected $table = 'shipment_resolutions';
    protected $guarded = ['id'];

    public function shipment() {
        return $this->belongsTo(Shipment::class, 'shipment_id');
    }

    public function logs() {
        return $this->hasMany(ShipmentReturnLogs::class);
    }

    public function messages() {
        return $this->hasMany(ShipmentResolutionMessage::class);
    }
}
