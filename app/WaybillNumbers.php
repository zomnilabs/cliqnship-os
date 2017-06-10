<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\SoftDeletes;

class WaybillNumbers extends Model
{
    use SoftDeletes;

    protected $table = 'waybill_numbers';
    protected $guarded = ['id'];
}
