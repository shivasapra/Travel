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
    
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {   
        $tax = settings::all();
        if($tax[0]->enable == 'yes'){
            foreach (invoice::all() as $invoice) {
            $taxed = ($tax[0]->tax/100)*$invoice->discounted_total;
            $total = $invoice->discounted_total + $taxed;
            $invoice->pending_amount = $total - $invoice->paid;
            $invoice->save();
            }
        }
        else{
            foreach (invoice::all() as $invoice){ 
                $invoice->pending = $discounted_total - $invoice->paid;
                $invoice->save();
            }
        }
        foreach (invoice::all() as $invoice) {
            if ($invoice->pending_amount > 0) {
                $invoice->status = 0;
            }
            else{
                $invoice->status =1;
            }
            $invoice->save();
        }

        return view('invoice.index')->with('invoices',invoice::all())
                                    ->with('tax',settings::all());;
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
        $invoice->discount = $request->discount;
        if ($request->currency[0] == '$') {
            $invoice->total = substr($request->total,1,3)*1;
            $invoice->discounted_total = substr($request->discounted_total,1,3)*1;
        }
        else{
            $invoice->total = substr($request->total,2,4)*1;
            $invoice->discounted_total = substr($request->discounted_total,2,4)*1;
        }
        $invoice->paid = 0;
        $invoice->pending_amount=0;
        if($request->credit != null){
            $invoice->credit = 1;
            $invoice->credit_amount = $request->credit_amount;
            $invoice->paid = $invoice->paid + $request->credit_amount;
        }
        if($request->debit != null){
            $invoice->debit = 1;
            $invoice->debit_amount = $request->debit_amount;
            $invoice->paid = $invoice->paid + $request->debit_amount;
        }
        if($request->cash != null){
            $invoice->cash = 1;
            $invoice->cash_amount = $request->cash_amount;
            $invoice->paid = $invoice->paid + $request->cash_amount;
        }
        if($request->bank != null){
            $invoice->bank = 1;
            $invoice->bank_amount = $request->bank_amount;
            $invoice->paid = $invoice->paid + $request->bank_amount;
        }
        $invoice->save();

        foreach($request->item_name as $index => $item_name){
            $invoice_info = new invoiceInfo;
            $invoice_info->invoice_id = $invoice->id;
            $invoice_info->item_name = $item_name;
            $invoice_info->item_subname = $request->item_subname[$index];
            $invoice_info->quantity = $request->quantity[$index];
            $invoice_info->currency = $request->currency[$index];
            $invoice_info->price = $request->price[$index];
            if ($request->currency[0] == '$') {
                $invoice_info->amount = substr($request->amount[$index],1,3)*1;
            }
            else{
                $invoice_info->amount = substr($request->amount[$index],2,4)*1;
            }
            // if ($request->status[$index]=='paid') {
            //     $invoice_info->status = 1;
            // }
            // if ($request->status[$index]=='unpaid') {
            //     $invoice_info->status = 0;
            // }
            $invoice_info->save();

        }
        Session::flash('success','Invoice Created Successfully');
            return redirect()->route('invoice');
        
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
        $invoice->discount = $request->discount;
        if ($request->currency[0] == '$') {
            $invoice->total = substr($request->total,1,3)*1;
            $invoice->discounted_total = substr($request->discounted_total,1,3)*1;
        }
        else{
            $invoice->total = substr($request->total,2,4)*1;
            $invoice->discounted_total = substr($request->discounted_total,2,4)*1;
        }
        $invoice->save();
        foreach($request->item_name as $index => $item_name){
            $invoice_info = invoiceInfo::where();
            $invoice_info->invoice_id = $invoice->id;
            $invoice_info->item_name = $item_name;
            $invoice_info->item_subname = $request->item_subname[$index];
            $invoice_info->quantity = $request->quantity[$index];
            $invoice_info->currency = $request->currency[$index];
            $invoice_info->price = $request->price[$index];
            if ($request->currency[0] == '$') {
                $invoice_info->amount = substr($request->amount[$index],1,3)*1;
            }
            else{
                $invoice_info->amount = substr($request->amount[$index],2,4)*1;
            }
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