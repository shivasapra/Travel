<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class wageLog extends Model
{
    protected $fillable = ['id','wage_id','date','login_time','logout_time','hours'];


    public function wage()
    {
    	return $this->belongsTo('App\wage');
    }
}
