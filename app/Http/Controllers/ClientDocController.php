<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\client;
use App\ClientDoc;
use App\invoiceInfo;
use Carbon\Carbon;
use Session;
use Mail;
class ClientDocController extends Controller
{   
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $invoices = invoiceInfo::where('service_name','test')->get();
        $docs = ClientDoc::where('date',Carbon::now()->timezone('Europe/London')->toDateString())->get();
        $clients = array();
        foreach(client::all() as $client){
            foreach($client->docs as $doc) {
                if ($doc->date == Carbon::now()->timezone('Europe/London')->toDateString()) {
                    array_push($clients,$client);
                    break;
                }
            }
        }
        return view('clientDoc.index')->with('invoices',$invoices)
                                        ->with('docs',$docs)
                                        ->with('clients',$clients);
    }

    public function redirected($name){
        $invoices = invoiceInfo::where('service_name','Visa Services')->where('receiver_name', 'like', '%'.$name.'%')->get();
        $docs = ClientDoc::where('date',Carbon::now()->timezone('Europe/London')->toDateString())->get();
        $clients = array();
        foreach(client::all() as $client){
            foreach($client->docs as $doc) {
                if ($doc->date == Carbon::now()->timezone('Europe/London')->toDateString()) {
                    array_push($clients,$client);
                    break;
                }
            }
        }
        return view('clientDoc.index')->with('invoices',$invoices)
                                        ->with('docs',$docs)
                                        ->with('clients',$clients);
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

    public function emergency(Request $request){
        $emails = array();
        foreach($request->email as $email){
            array_push($emails,$email);
        }
        $data = array('content'=>$request->message);
        Mail::send('emails.emergency', $data, function($message) use ($emails)
        { 
            $message->to($emails)->subject( 'Emergency Message Related To Visa Documents' );
        });
        Session::flash('success','Message Sent!');
        return redirect()->back();
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
       $doc->client_id = $invoiceInfo->invoice->client->id;
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
        return redirect()->route('redirected',['name'=>$invoiceInfo->receiver_name]);
    }

    public function destroy($id)
    {
        $doc = ClientDoc::find($id);
        $doc->delete();
        Session::flash('warning','One Record Removed');
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
    
}
