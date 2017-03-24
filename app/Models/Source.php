<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Source extends Model
{
    use SoftDeletes;

    protected $guarded = ['id'];

    public function booking()
    {
        return $this->hasMany(Booking::class);
    }
}
