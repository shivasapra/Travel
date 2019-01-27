<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class invoice extends Model
{
    protected $fillable = ['receiver_name','billing_address','invoice_date','invoice_no'];


    public function invoiceInfo()
    {
        return $this->hasMany('App\invoiceInfo');
    }
}
