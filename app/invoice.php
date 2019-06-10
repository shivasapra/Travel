<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class invoice extends Model
{

    use SoftDeletes;

    protected $fillable = ['receiver_name','VAT_percentage','VAT_amount','currency','billing_address','invoice_date','invoice_no','pending_amount','discount','credit','credit_amount','debit','debit_amount','cash','cash_amount','bank','bank_amount','total','discounted_total','paid','status','client_id','mail_sent'];
    protected $dates = ['deleted_at'];

    public function invoiceInfo()
    {
        return $this->hasMany('App\invoiceInfo');
    }
    public function flights()
    {
        return $this->hasMany('App\Flight');
    }
    public function client()
    {
        return $this->belongsTo('App\client');
    }
}
