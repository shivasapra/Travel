<?php

namespace App\Http\Controllers;
use App\invoice;
use App\settings;
use App\expenses;
use App\invoiceInfo;
use App\ClientDoc;
use App\products;
use App\Flight;
use Illuminate\Http\Request;

class ReportController extends Controller
{   
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function paidInvoice(){
    	return view('reports.paidInvoice')
    	->with('tax',settings::all())
        ->with('invoices',invoice::where('status',1)->orderBy('id','desc')->get())
        ->with('products',products::all());
    }

    public function invoice(Request $request){
        if ($request->service_name =='Flight') {
            $invoices = Flight::orderBy('id','desc')->get();
        }
        else{
            $invoices = invoiceInfo::where('service_name',$request->service_name)->orderBy('id','desc')->get();
        }
        return view('reports.invoice')
    	->with('tax',settings::all())
        ->with('invoices',$invoices)
        ->with('products',products::all())
        ->with('service_name',$request->service_name);
    }


    public function unpaidInvoice(){
    	return view('reports.unpaidInvoice')
    	->with('tax',settings::all())
        ->with('invoices',invoice::where('status',0)->orderBy('id','desc')->get())
        ->with('products',products::all());
    }

    public function expenses(){
        return view('reports.expenses')
        ->with('expenses',expenses::orderBy('id','desc')->get());
  }

    public function visa(){
        $invoices = invoiceInfo::where('service_name','Visa Services')->orderBy('id','desc')->get();
        return view('reports.visa')->with('invoices',$invoices);
    }

    public function docMovement(){
        $docs = ClientDoc::orderBy('id','desc')->get();
        return view('reports.docsMovement')->with('docs',$docs);
    }
}
