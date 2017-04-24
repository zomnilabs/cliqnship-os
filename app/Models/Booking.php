<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Booking extends Model
{
    use SoftDeletes;

    protected $guarded = ['id'];

    public static $filterables = [
        'source_id',
        'user_addressbook_id',
        'status',
        'pickup_date',
        'number_of_items',
        'type_of_items'
    ];

    public function address()
    {
        return $this->belongsTo(UserAddressbook::class, 'user_addressbook_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function assignment()
    {
        return $this->hasOne(BookingAssignment::class);
    }

    public function source()
    {
        return $this->belongsTo(Source::class);
    }
}
