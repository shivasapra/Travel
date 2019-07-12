<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class invoiceInfo extends Model
{
    protected $table = 'invoice_infos';
    
    public function invoice()
    {
        return $this->belongsTo('App\invoice');
    }
}












