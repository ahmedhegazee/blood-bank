<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model 
{

    protected $table = 'posts';
    public $timestamps = true;
    protected $fillable = array('title', 'content', 'photo');

    public function category()
    {
        return $this->belongsTo('Category');
    }

    public function favouritedClients()
    {
        return $this->morphToMany('Client', 'clientable');
    }

}