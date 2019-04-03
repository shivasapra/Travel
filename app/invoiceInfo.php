<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class invoiceInfo extends Model
{
    protected $guarded = [‘*’];
    public function invoice()
    {
        return $this->belongsTo('App\invoice');
    }
}












