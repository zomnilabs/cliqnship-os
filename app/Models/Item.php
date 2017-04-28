<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Item extends Model
{
    use SoftDeletes;

    protected $guarded = ['id'];

    public function requests()
    {
        return $this->hasMany(ItemRequest::class);
    }
}
