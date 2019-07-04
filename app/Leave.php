<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Leave extends Model
{
    protected $table = 'leaves';

    public function employee()
    {
    	return $this->belongsTo('App\employee');
    }
}
