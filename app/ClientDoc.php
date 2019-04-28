<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ClientDoc extends Model
{
    protected $table = 'client_docs';

    public function client()
    {
        return $this->belongsTo('App\client');
    }
}
