<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class wage extends Model
{
    protected $table = 'wages';

    public function employee()
    {
    	return $this->belongsTo('App\employee');
    }

    public function wageLog()
    {
    	return $this->hasMany('App\wageLog');
    }
}
