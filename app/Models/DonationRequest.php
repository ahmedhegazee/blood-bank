<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class DonationRequest extends Model
{

    protected $table = 'donation_requests';
    public $timestamps = true;
    protected $fillable = array('name', 'age', 'no_blood_bags', 'phone', 'notes', 'address', 'longtitude', 'latitude');

    public function client()
    {
        return $this->belongsTo('Client');
    }
}
