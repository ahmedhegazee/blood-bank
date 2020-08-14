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
    protected $fillable = array('name', 'password', 'email', 'phone', 'dob', 'last_donation_date', 'city_id', 'blood_type_id');
    protected $hidden = [
        'password', 'api_token', 'pin_code'
    ];
    public function city()
    {
        return $this->belongsTo('City');
    }

    public function bloodType()
    {
        return $this->belongsTo('BloodType');
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
    public function scopeSearchBloodType($query, $blood)
    {
        return $query->where('blood_type_id', $blood);
    }
    public function scopeSearchCity($query, $city)
    {
        return $query->where('city_id', $city);
    }
    public function tokens()
    {
        return $this->hasMany('App\Models\Token');
    }
}
