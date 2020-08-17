<?php

namespace App\Models;

use Illuminate\Auth\Middleware\Authenticate;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Client extends Authenticatable
{
    use Notifiable;
    protected $table = 'clients';
    protected $guard = 'clients';
    public $timestamps = true;
    protected $fillable = array('name', 'password', 'email', 'phone', 'dob', 'last_donation_date', 'city_id', 'blood_type_id', 'is_banned');
    protected $hidden = [
        'password', 'api_token', 'pin_code'
    ];
    public function city()
    {
        return $this->belongsTo('App\Models\City');
    }

    public function bloodType()
    {
        return $this->belongsTo('App\Models\BloodType');
    }

    public function favouritePosts()
    {
        return $this->morphedByMany('App\Models\Post', 'clientable');
    }

    public function bloodTypes()
    {
        return $this->morphedByMany('App\Models\BloodType', 'clientable');
    }

    public function governments()
    {
        return $this->morphedByMany('App\Models\Government', 'clientable');
    }

    public function messages()
    {
        return $this->hasMany('App\Models\ClientMessage');
    }

    public function notifications()
    {
        return $this->morphedByMany('App\Models\Notification', 'clientable');
    }

    public function donationRequests()
    {
        return $this->hasMany('App\Models\DonationRequest');
    }

    public function tokens()
    {
        return $this->hasMany('App\Models\Token');
    }
    public function getBannedStatus()
    {
        return [
            0 => 'Not Banned',
            1 => 'Banned'
        ][$this->is_banned];
    }
    public function scopeSearch($query, $search = null)
    {
        //to make the filtering by governs is optional
        return $query->where(function ($query) use ($search) {
            if (!is_null($search))
                $query->where('name', 'like', '%' . $search . '%')
                    ->orWhere('phone', 'like', '%' . $search . '%')
                    ->orWhere('email', 'like', '%' . $search . '%');
        });
    }
    public function scopeSearchBloodType($query, $blood = null)
    {
        //to make the filtering by governs is optional
        return $query->where(function ($query) use ($blood) {
            if (!is_null($blood))
                $query->where('blood_type_id', $blood);
        });
    }
    public function scopeSearchCity($query, $city = null)
    {
        return $query->where(function ($query) use ($city) {
            if (!is_null($city))
                $query->where('city_id', $city);
        });
    }
}
