<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Flight extends Model
{
    protected $table = 'flights';

    public function invoice()
    {
        return $this->belongsTo('App\invoice');
    }
    
    public function passengers()
    {
        return $this->hasMany('App\Passenger');
    }
}
