<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class ClientMessage extends Model
{

    protected $table = 'client_messages';
    public $timestamps = true;
    protected $fillable = array('title', 'content');

    public function client()
    {
        return $this->belongsTo('App\Models\Client');
    }
}
