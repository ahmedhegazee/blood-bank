<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class DonationRequest extends Model
{

    protected $table = 'donation_requests';
    public $timestamps = true;
    protected $fillable = array('name', 'age', 'no_blood_bags', 'phone', 'notes', 'address', 'longtitude', 'latitude', 'blood_type_id', 'city_id');

    public function client()
    {
        return $this->belongsTo('Client');
    }
    public function city()
    {
        return $this->belongsTo(City::class);
    }
    public function notifications()
    {
        return $this->hasMany(Notification::class);
    }
    public function bloodType()
    {
        return $this->belongsTo(BloodType::class);
    }
}
