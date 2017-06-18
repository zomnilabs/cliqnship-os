<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class ShipmentReturnLogs extends Model
{
    protected $guarded = ['id'];

    public function shipment() {
        return $this->belongsTo(Shipment::class);
    }

    public function user() {
        return $this->belongsTo(User::class, 'user_id');
    }
}
