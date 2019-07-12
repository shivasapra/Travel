<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class employee extends Model
{
    protected $table = 'employees';

    public function wage()
    {
    	return $this->hasMany('App\wage');
    }

    public function user()
    {
    	return $this->belongsTo('App\User');
    }

    public function assignment()
    {
    	return $this->hasMany('App\assignment');
    }

    public function leaves()
    {
    	return $this->hasMany('App\Leave');
    }  
}
