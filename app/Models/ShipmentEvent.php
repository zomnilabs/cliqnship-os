<?php

namespace App;

use App\Models\Shipment;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ShipmentEvent extends Model
{
    use SoftDeletes;

    protected $guarded = ['id'];

    public function shipment()
    {
        return $this->belongsTo(Shipment::class);
    }
}
