<?php

namespace App\Http\Controllers;
use App\invoice;
use App\settings;
use App\expenses;
use App\invoiceInfo;
use App\ClientDoc;
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

    public function visa(){
        $invoices = invoiceInfo::where('service_name','Visa Services')->get();
        return view('reports.visa')->with('invoices',$invoices);
    }

    public function docMovement(){
        $docs = ClientDoc::all();
        return view('reports.docsMovement')->with('docs',$docs);
    }
}
