<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class client extends Model
{
    protected $table = 'clients';

    public function invoices()
    {
        return $this->hasMany('App\invoice');
    }
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function family()
    {
        return $this->hasMany('App\ClientFamily');
    }

    public function docs()
    {
        return $this->hasMany('App\ClientDoc');
    }

    public function requests()
    {
        return $this->hasMany('App\ClientRequests');
    }

    public function lead()
    {
        return $this->hasOne('App\Leads');
    }
}
