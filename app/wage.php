<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class wage extends Model
{
    protected $fillable = ['id','employee_id','unique_id','date','no_of_logins','total_hours','hourly','today_wage'];

    public function employee()
    {
    	return $this->belongsTo('App\employee');
    }

    public function wageLog()
    {
    	return $this->hasMany('App\wageLog');
    }
}
