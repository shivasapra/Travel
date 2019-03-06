<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class assignment extends Model
{
    protected $fillable = ['employee_id','task','status','task_description','date'];

    public function employee()
    {
    	return $this->belongsTo('App\employee');
    }
}
