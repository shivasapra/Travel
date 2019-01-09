<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class expenses extends Model
{
    protected $fillable = ['date','amount','description','auto','start_date','end_date','deduction_date','status','latest','company_name','invoice_no'];
}
