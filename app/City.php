<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class City extends Model 
{

    protected $table = 'cities';
    public $timestamps = true;
    protected $fillable = array('name');

    public function government()
    {
        return $this->belongsTo('Government');
    }

    public function favouriteClients()
    {
        return $this->morphToMany('Client', 'clientable');
    }

}