<?php

namespace App\Http\Controllers;
use App\invoice;
use App\settings;
use App\expenses;
use App\invoiceInfo;
use App\ClientDoc;
use App\products;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function paidInvoice(){
    	return view('reports.paidInvoice')
    	->with('tax',settings::all())
        ->with('invoices',invoice::all())
        ->with('products',products::all());
    }

    public function invoice(Request $request){
        $invoices = invoiceInfo::where('service_name',$request->service_name)->get();
        return view('reports.invoice')
    	->with('tax',settings::all())
        ->with('invoices',$invoices)
        ->with('products',products::all())
        ->with('service_name',$request->service_name);
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
