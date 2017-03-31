<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ShipmentAssignment extends Model
{
    use SoftDeletes;

    protected $guarded = ['id'];

    public function user()
    {
        $this->belongsTo(User::class);
    }
}
