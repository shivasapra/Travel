<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ClientRequests extends Model
{
    protected $table = 'client_requests';

    public function client()
    {
        return $this->belongsTo('App\client');
    }
}
