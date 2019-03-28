<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class invoiceInfo extends Model
{
    protected $fillable = ['invoice_id','service_name','airline_name','source','destination','date_of_travel','adult','child','infant','name_of_visa_applicant','passport_origin','visa_country','visa_type','visa_charges','quantity','currency','price','amount'];
    public function invoice()
    {
        return $this->belongsTo('App\invoice');
    }
}













