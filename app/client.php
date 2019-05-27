<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class client extends Model
{
    protected $table = 'clients';

    public function invoice()
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
}
