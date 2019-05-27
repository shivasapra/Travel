<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ClientFamily extends Model
{
    protected $table = 'client_families';

    public function client()
    {
        return $this->belongsTo('App\client');
    }
}
