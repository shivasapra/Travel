<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\airlines;
use App\products;
use App\invoice;
use App\invoiceInfo;
use Session;
use App\client;
use GuzzleHttp;
use App\settings;
class InvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        
        return view('invoice.index')->with('invoices',invoice::all());
    }

    public function invoicePrint($id)
    {   
        return view('invoice-print')->with('invoice',invoice::find($id))
                                        ->with('products',products::all())
                                        ->with('airlines',airlines::all())
                                        ->with('tax',settings::all());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {   

        $invoice = invoice::where('invoice_no','CLD0001')->get();
        if ($invoice->count()>0) {
            $latest = invoice::orderBy('created_at','desc')->take(1)->get();
            $invoice_prev_no = $latest[0]->invoice_no;
            $invoice_no = 'CLD000'.(substr($invoice_prev_no,3,6)+1);
            // dd($invoice_no);
        }
        else{
            $invoice_no = 'CLD0001';
        }
        // $invoice_no = 'CLD'. mt_rand(10000, 99999);
        // while (invoice::where('invoice_no',$invoice_no)->get()->count()>0) {
        //    $invoice_no = 'CLD'. mt_rand(10000, 99999); 
        // }
        if(client::all()->count()==0){
            session::flash('warning','you must have atleast one client to create an invoice');
            return redirect()->back();
        }
        $test = client::all();
        $json = json_encode($test);
        return view('invoice.create')->with('products',products::all())
                                    ->with('airlines',airlines::all())
                                    ->with('invoice_no',$invoice_no)
                                    ->with('clients',client::all())
                                    ->with('json',$json);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        $invoice = new invoice;
        $client = client::find($request->receiver_name);
        $invoice->receiver_name = $client->first_name.' '.$client->last_name;
        $invoice->billing_address = $request->billing_address;
        $invoice->invoice_date = $request->invoice_date;
        $invoice->invoice_no = $request->invoice_no;
        $invoice->save();

        foreach($request->item_name as $index => $item_name){
            $invoice_info = new invoiceInfo;
            $invoice_info->invoice_id = $invoice->id;
            $invoice_info->item_name = $item_name;
            $invoice_info->item_subname = $request->item_subname[$index];
            $invoice_info->quantity = $request->quantity[$index];
            $invoice_info->currency = $request->currency[$index];
            $invoice_info->price = $request->price[$index];
            $invoice_info->amount = $request->price[$index] * $request->quantity[$index];
            if ($request->status[$index]=='paid') {
                $invoice_info->status = 1;
            }
            if ($request->status[$index]=='unpaid') {
                $invoice_info->status = 0;
            }
            $invoice_info->save();

        }
        Session::flash('success','Invoice Created Successfully');
            return redirect()->back();
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('invoice')->with('invoice',invoice::find($id))
                                ->with('products',products::all())
                                    ->with('airlines',airlines::all())
                                    ->with('tax',settings::all());
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $invoice = invoice::find($id);
        return view('invoice.edit')->with('invoice',$invoice)
                                    ->with('products',products::all())
                                    ->with('airlines',airlines::all());

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {   
        $invoice = invoice::find($id);
        $invoice->receiver_name = $request->receiver_name;
        $invoice->billing_address = $request->billing_address;
        $invoice->invoice_date = $request->invoice_date;
        $invoice->invoice_no = $request->invoice_no;
        $invoice->save();
        foreach($request->item_name as $index => $item_name){
            $invoice_info = invoiceInfo::where();
            $invoice_info->invoice_id = $invoice->id;
            $invoice_info->item_name = $item_name;
            $invoice_info->item_subname = $request->item_subname[$index];
            $invoice_info->quantity = $request->quantity[$index];
            $invoice_info->currency = $request->currency[$index];
            $invoice_info->price = $request->price[$index];
            $invoice_info->amount = $request->price[$index] * $request->quantity[$index];
            $invoice_info->status = $request->status[$index];
            $invoice_info->save();

        }
        Session::flash('success','Invoice Updated Successfully');
            return redirect()->route('invoice')->with('invoices',invoice::all());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $invoice = invoice::find($id);
        $invoice->delete();
        Session::flash('success','Invoice Deleted Successfully');
        return redirect()->back()->with('invoices',invoice::all());
    }
}




// $invoice = invoice::where(invoice_no);
        // $client = new GuzzleHttp\Client();
        // $res = $client->get('https://api.postcodes.io/postcodes?q=OX495NU');
        // dd($res);
        // dd($res->getStatusCode());
        // $json = json_decode(file_get_contents('https://api.postcodes.io/postcodes?q=OX495NU'), true);
        // $result = json_decode(file_get_contents('https://api.postcodes.io/postcodes?q=OX495NU'), true);
        // dd($result);
        // dd($json['result'][0]['postcode']);
        // $request = Request::create('http://api.postcodes.io/postcodes/B289EU', 'GET');
        // dd($request);