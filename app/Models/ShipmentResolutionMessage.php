<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ShipmentResolutionMessage extends Model
{
    use SoftDeletes;

    public function resolution()
    {
        return $this->belongsTo(ShipmentResolution::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
