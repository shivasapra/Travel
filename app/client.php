<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class client extends Model
{
    protected $fillable = ['first_name','last_name','address','postal_code','city','county','country','phone','DOB','email']; 
}
