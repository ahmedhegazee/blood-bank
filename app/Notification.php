<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model 
{

    protected $table = 'notifications';
    public $timestamps = true;

    public function clients()
    {
        return $this->morphToMany('Client', 'clientable');
    }

    public function donationRequest()
    {
        return $this->belongsTo('DonationRequest');
    }

}