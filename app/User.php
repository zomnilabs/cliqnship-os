<?php

namespace App;

use App\Models\Booking;
use App\Models\ShipmentAssignment;
use App\Models\UserAddressbook;
use App\Models\UserGroup;
use App\Models\UserProfile;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    use Notifiable, HasApiTokens;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded = ['id'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token', 'can_use_api',
        'account_type', 'login_type'
    ];

    public function profile()
    {
        return $this->hasOne(UserProfile::class);
    }

    public function userGroup()
    {
        return $this->belongsTo(UserGroup::class);
    }

    public function addressbook()
    {
        return $this->hasMany(UserAddressbook::class);
    }

    public function booking()
    {
        return $this->hasMany(Booking::class);
    }

    public function shipmentAssignments()
    {
        return $this->hasMany(ShipmentAssignment::class);
    }

    // Mutator
    public function setUserGroupAttribute($value)
    {
        // Get value of usergroup
        $userGroup = UserGroup::where('slug', $value)->first();

        $this->attributes['user_group_id'] = $userGroup;
    }
}
