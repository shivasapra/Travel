<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\client;
use App\ClientDoc;
use App\invoiceInfo;
use Carbon\Carbon;
use Session;
class ClientDocController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $invoices = invoiceInfo::where('service_name','test')->get();
        $docs = ClientDoc::where('date',Carbon::now()->timezone('Europe/London')->toDateString())->get();
        return view('clientDoc.index')->with('invoices',$invoices)
                                        ->with('docs',$docs);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request,$id)
    {   
       $invoiceInfo = invoiceInfo::find($id);
       $doc = new ClientDoc;
       $doc->date = Carbon::now()->timezone('Europe/London')->toDateString();
       $doc->client_name = $invoiceInfo->receiver_name;
       $doc->mobile = $invoiceInfo->invoice->client->phone;
       $doc->visa_applicant_name = $invoiceInfo->name_of_visa_applicant;
       $doc->DOB = $invoiceInfo->passport_member_DOB;
       $doc->passport_origin = $invoiceInfo->passport_origin;
       $doc->passport_no = $invoiceInfo->passport_no;
       $doc->visa_country = $invoiceInfo->visa_country;
       $doc->visa_type = $invoiceInfo->visa_type;
       $doc->save();
       Session::flash('success','One Record Added');
       return redirect()->route('clientDocIndex');
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
        $doc = ClientDoc::find($id);
        $doc->delete();
        Session::flash('warning','One Record Removed');
        return redirect()->route('clientDocIndex');
    }
}
