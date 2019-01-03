<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class wage extends Model
{
    protected $fillable = ['employee_id','unique_id','login','logout','date','hourly',
    'wage'];

    public function employee()
    {
    	return $this->belongsTo('App\employee');
    }
}
