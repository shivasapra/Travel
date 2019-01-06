<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\airlines;
use App\products;
use App\invoice;
class InvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        // $invoice = invoice::where(invoice_no);
        return view('invoice.index')->with('invoices',invoice::all());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('invoice.create')->with('products',products::all())
                                    ->with('airlines',airlines::all());
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
        // $array = array_combine($request->receiver_name,$request->billing_address,$request->invoice_date,$request->invoice_no,$request->item_name,$request->item_subname,$request->quantity,$request->currency,$request->price,$request->amount,
        //     $request->status);
        // foreach($array as $receiver_name => $billing_address => $invoice_date 
        //     => $invoice_no => $item_name => $item_subname => $quantity => $currency
        //     => $price => $amount => $status){
        //     $invoice->receiver_name = $receiver_name;
        //     $invoice->billing_address = $billing_address;
        //     $invoice->invoice_date = $invoice_date;
        //     $invoice->invoice_no = $invoice_no;
        //     $invoice->item_name = $item_name;
        //     $invoice->item_subname = $item_subname;
        //     $invoice->quantity = $quantity;
        //     $invoice->currency = $currency;
        //     $invoice->price = $price;
        //     $invoice->amount = $amount;
        //     $invoice->status = $status;
        //     $invoice->save();
        // }
        foreach($request->item_name as $index => $item_name){
            $invoice->receiver_name = $request->receiver_name;
            $invoice->billing_address = $request->billing_address;
            $invoice->invoice_date = $request->invoice_date;
            $invoice->invoice_no = $request->invoice_no;
            $invoice->item_name = $item_name;
            $invoice->item_subname = $request->item_subname[$index];
            $invoice->quantity = $request->quantity[$index];
            $invoice->currency = $request->currency[$index];
            $invoice->price = $request->price[$index];
            $invoice->amount = $request->price[$index] * $request->quantity[$index];
            $invoice->status = $request->status[$index];
            $invoice->save();

        }
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
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
        return redirect()->back()->with('invoices',invoice::all());
    }
}
