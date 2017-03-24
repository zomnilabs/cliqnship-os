<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ItemRequest extends Model
{
    use SoftDeletes;

    protected $guarded = ['id'];

    public function address()
    {
        return $this->belongsTo(UserAddressbook::class, 'user_addressbook_id');
    }

    public function source()
    {
        return $this->belongsTo(Source::class);
    }
}
