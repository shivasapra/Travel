<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Leads extends Model
{   

    protected $table = 'leads';

    public function user()
    {   
    	return $this->belongsTo('App\User');
    }
    
    public function client()
    {   
    	return $this->belongsTo('App\client');
    }
}
