<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Post extends Model
{

    protected $table = 'posts';
    public $timestamps = true;
    protected $fillable = array('title', 'content', 'photo');

    public function category()
    {
        return $this->belongsTo('App\Models\Category');
    }

    public function favouritedClients()
    {
        return $this->morphToMany('App\Models\Client', 'clientable');
    }
}
