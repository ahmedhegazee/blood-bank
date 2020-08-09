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
        'password', 'api_token',
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
        return $this->morphedByMany('Post', 'clientable');
    }

    public function favouriteBloodTypes()
    {
        return $this->morphedByMany('BloodType', 'clientable');
    }

    public function favouriteCities()
    {
        return $this->morphedByMany('City', 'clientable');
    }

    public function messages()
    {
        return $this->hasMany('ClientMessage');
    }

    public function notifications()
    {
        return $this->morphedByMany('Notification', 'clientable');
    }

    public function donationRequests()
    {
        return $this->hasMany('DonationRequest');
    }
}
