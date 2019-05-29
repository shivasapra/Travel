<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class assignment extends Model
{
    protected $table = 'assignments';

    public function employee()
    {
    	return $this->belongsTo('App\employee');
    }
}
