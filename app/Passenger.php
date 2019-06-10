<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Passenger extends Model
{

    protected $table = 'passengers';
    public function flight()
    {
        return $this->belongsTo('App\flight');
    }
}
