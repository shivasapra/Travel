<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class invoiceInfo extends Model
{
    protected $fillable = ['invoice_id','service_name','airline_name','source','destination','date_of_travel',
                            'adult','child','infant','name_of_visa_applicant','passport_origin','visa_country',
                            'visa_type','visa_charges','quantity','currency','price','amount','infant_dob','hotel_city',
                            'hotel_country',    'hotel_name',    'check_in_date',    'check_out_date',    'no_of_children',
                            'no_of_rooms',    'name_of_insurance_applicant',    'insurance_remarks',    'local_sight_sceen_remarks',
                            'other_facilities_remarks',    'car_rental_remarks',    'local_transport_remarks'];
    public function invoice()
    {
        return $this->belongsTo('App\invoice');
    }
}












