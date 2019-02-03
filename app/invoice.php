<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class invoice extends Model
{
    protected $fillable = ['receiver_name','billing_address','invoice_date','invoice_no','pending_amount','discount','credit','credit_amount','debit','debit_amount','cash','cash_amount','bank','bank_amount','total','discounted_total','paid','status','client_id','mail_sent'];


    public function invoiceInfo()
    {
        return $this->hasMany('App\invoiceInfo');
    }
    public function client()
    {
        return $this->belongsTo('App\client');
    }
}
