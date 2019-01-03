<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class expenses extends Model
{
    protected $fillable = ['date','amount','description','auto','start_date','end_date'];
}
