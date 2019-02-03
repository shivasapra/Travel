<?php

namespace App\Http\Controllers;
use App\invoice;
use App\settings;
use App\expenses;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function paidInvoice(){
    	return view('reports.paidInvoice')
    	->with('tax',settings::all())
    	->with('invoices',invoice::where('status',1)->get());
    }

    public function unpaidInvoice(){
    	return view('reports.unpaidInvoice')
    	->with('tax',settings::all())
    	->with('invoices',invoice::where('status',0)->get());
    }

    public function expenses(){
        return view('reports.expenses')
        ->with('expenses',expenses::all());
    }

}
