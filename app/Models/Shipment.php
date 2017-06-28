<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Shipment extends Model
{
    use SoftDeletes;

    protected $guarded = ['id'];
    protected $hidden = ['deleted_at'];

    public static $filterables = [
        'source_id',
        'from',
        'to',
        'service_type',
        'collect_and_deposit',
        'insurance_declared_value',
        'charge_to',
        'pay_thru',
        'package_type',
        'status',
        'pickup_date',
        'number_of_items',
        'type_of_items'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function address()
    {
        return $this->belongsTo(UserAddressbook::class, 'to');
    }

    public function senderAddress()
    {
        return $this->belongsTo(UserAddressbook::class, 'from');
    }

    public function source()
    {
        return $this->belongsTo(Source::class);
    }

    public function trackingNumbers()
    {
        return $this->hasMany(ShipmentTrackingNumber::class);
    }

    public function rider()
    {
        return $this->hasOne(ShipmentAssignment::class, 'shipment_id');
    }

    public function events()
    {
        return $this->hasMany(ShipmentEvent::class);
    }

    public function returnLogs()
    {
        return $this->hasMany(ShipmentReturnLogs::class);
    }

    public function remarks()
    {
        return $this->hasMany(ShipmentRemarks::class);
    }

    public function cod()
    {
        return $this->hasOne(ShipmentCod::class, 'shipment_id');
    }
}
