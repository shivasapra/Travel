<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class invoice extends Model
{
    protectted $fillable = ['receiver_name','billing_address','invoice_date','invoice_no','item_name','item_subname','quantity','currency','price','amount','status'];
}
