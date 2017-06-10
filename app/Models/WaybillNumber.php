<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class WaybillNumber extends Model
{
    use SoftDeletes;

    protected $table = 'waybill_numbers';
    protected $guarded = ['id'];
}
