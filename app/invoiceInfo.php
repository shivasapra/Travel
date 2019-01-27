<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class invoiceInfo extends Model
{
    protected $fillable = ['invoice_id','item_name','item_subname','quantity','currency','price','amount','status'];

    public function invoice()
    {
        return $this->belongsTo('App\invoice');
    }
}
