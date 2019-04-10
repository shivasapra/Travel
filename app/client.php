<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class client extends Model
{
    protected $fillable = ['first_name','last_name','address','postal_code','city','county','country','phone','DOB','email','passport','passport_no','passport_expiry_date','passport_issue_date','passport_place','passport_front','passport_back','letter','mail_sent','token','confirmation','user_id','permanent','credit_limit','currency','status'];

    public function invoice()
    {
        return $this->hasMany('App\invoice');
    }
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function Family()
    {
        return $this->hasMany('App\ClientFamily');
    }
}
