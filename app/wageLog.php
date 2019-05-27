<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class wageLog extends Model
{
    protected $table = 'wage_logs';


    public function wage()
    {
    	return $this->belongsTo('App\wage');
    }
}
