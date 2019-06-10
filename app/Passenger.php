<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Passenger extends Model
{
    public function flight()
    {
        return $this->belongsTo('App\flight');
    }
}
