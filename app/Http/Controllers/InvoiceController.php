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
use Carbon\Carbon;
use PDF;
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
                                    ->with('tax',settings::all());
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
        $dt = Carbon::now();
        $dt->timezone('Asia/Kolkata');
        $date_today = $dt->timezone('Europe/London');
        $date = $date_today->toDateString();
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
                                    ->with('json',$json)
                                    ->with('date',$date);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {


         $dt = Carbon::now();
        $date_today = $dt->timezone('Europe/London');
        $date = $date_today->toDateString();
        $invoice = new invoice;
        $client = client::find($request->receiver_name);
        $invoice->client_id = $client->id;
        $invoice->receiver_name = $client->first_name.' '.$client->last_name;
        $invoice->billing_address = $request->billing_address;
        $invoice->invoice_date = $request->invoice_date;
        $invoice->invoice_no = $request->invoice_no;
        $invoice->discount = $request->discount;
        $invoice->currency = $request->currency;
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
        $invoice->mail_sent = $date;
        $invoice->save();

        $flight_counter=0;
        $visa_counter=0;
        $insurance_counter=0;
        $hotel_counter=0;
        for ($k = 0; $k < count($request->service_name); $k++) {
            if ($request->service_name[$k]=='Flight') {
                $invoice_info = new invoiceInfo;
                        $invoice_info->invoice_id = $invoice->id;
                        $invoice_info->service_name = 'Flight';

                        $invoice_info->airline_name = $request->airline_name[$flight_counter];
                        $invoice_info->source = $request->source[$flight_counter];
                        $invoice_info->destination = $request->destination[$flight_counter];
                        $invoice_info->date_of_travel = $request->date_of_travel[$flight_counter];
                        $invoice_info->adult = $request->adult[$flight_counter];
                        $invoice_info->child = $request->child[$flight_counter];
                        $invoice_info->infant = $request->infant[$flight_counter];
                        $invoice_info->infant_dob = $request->infant_dob[$flight_counter];
                        $invoice_info->flight_amount = $request->flight_amount[$flight_counter];
                        $invoice_info->flight_quantity = $request->flight_quantity[$flight_counter];
                        $invoice_info->flight_price = $request->flight_price[$flight_counter];
                        $invoice_info->save();
                        $flight_counter++;
            }

            if ($request->service_name[$k]=='Visa Services') {
                $invoice_info = new invoiceInfo;
                        $invoice_info->invoice_id = $invoice->id;
                        $invoice_info->service_name = 'Visa Services';


                        $invoice_info->save();
                        $visa_counter++;
            }

            if ($request->service_name[$k]=='Insurance') {
                $invoice_info = new invoiceInfo;
                        $invoice_info->invoice_id = $invoice->id;
                        $invoice_info->service_name = 'Insurance';


                        $invoice_info->save();
                        $insurance_counter++;
            }

            if ($request->service_name[$k]=='Hotel') {
                $invoice_info = new invoiceInfo;
                        $invoice_info->invoice_id = $invoice->id;
                        $invoice_info->service_name = 'Hotel';


                        $invoice_info->save();
                        $hotel_counter++;
            }
        }
        // foreach($request->service_name == 'Flight' as $index => $service_name){
        //     $invoice_info = new invoiceInfo;
        //     $invoice_info->invoice_id = $invoice->id;
        //     $invoice_info->service_name = $service_name;


        //     $invoice_info->airline_name = $request->airline_name[$index];
        //     $invoice_info->source = $request->source[$index];
        //     $invoice_info->destination = $request->destination[$index];
        //     $invoice_info->date_of_travel = $request->date_of_travel[$index];
        //     $invoice_info->adult = $request->adult[$index];
        //     $invoice_info->child = $request->child[$index];
        //     $invoice_info->infant = $request->infant[$index];
        //     $invoice_info->infant_dob = $request->infant_dob[$index];
        //     $invoice_info->flight_amount = $request->flight_amount[$index];
        //     $invoice_info->flight_quantity = $request->flight_quantity[$index];
        //     $invoice_info->flight_price = $request->flight_price[$index];
        //     $invoice_info->save();
        // }
        // if ($service_name == 'Visa Services') {
        //     $invoice_info->name_of_visa_applicant = $request->name_of_visa_applicant[$index];
        //     $invoice_info->passport_origin = $request->passport_origin[$index];
        //     $invoice_info->visa_country = $request->visa_country[$index];
        //     $invoice_info->visa_type = $request->visa_type[$index];
        //     $invoice_info->visa_charges = $request->visa_charges[$index];
        //     $invoice_info->service_charge = $request->service_charge[$index];
        //     $invoice_info->visa_amount = $request->visa_amount[$index];
        // }

        // if ($service_name == 'Hotel') {
        //     $invoice_info->hotel_city = $request->hotel_city[$index];
        //     $invoice_info->hotel_country = $request->hotel_country[$index];
        //     $invoice_info->hotel_name = $request->hotel_name[$index];
        //     $invoice_info->check_in_date = $request->check_in_date[$index];
        //     $invoice_info->check_out_date = $request->check_out_date[$index];
        //     $invoice_info->no_of_children = $request->no_of_children[$index];
        //     $invoice_info->no_of_rooms = $request->no_of_rooms[$index];
        //     $invoice_info->hotel_amount = $request->hotel_amount[$index];
        // }

        // if ($service_name == 'Insurance') {
        //     $invoice_info->name_of_insurance_applicant = $request->name_of_insurance_applicant[$index];
        //     $invoice_info->insurance_amount = $request->insurance_amount[$index];
        //     $invoice_info->insurance_remarks = $request->insurance_remarks[$index];
        // }

        // if ($service_name == 'Local Sight Sceen') {
        //     $invoice_info->local_sight_sceen_amount = $request->local_sight_sceen_amount[$index];
        //     $invoice_info->local_sight_sceen_remarks = $request->local_sight_sceen_remarks[$index];
        // }

        // if ($service_name == 'Other Facilities') {
        //     $invoice_info->other_facilities_amount = $request->other_facilities_amount[$index];
        //     $invoice_info->other_facilities_remarks = $request->other_facilities_remarks[$index];
        // }

        // if ($service_name == 'Car Rental') {
        //     $invoice_info->car_rental_amount = $request->car_rental_amount[$index];
        //     $invoice_info->car_rental_remarks = $request->car_rental_remarks[$index];
        // }

        // if ($service_name == 'Local Transport') {
        //     $invoice_info->local_transport_amount = $request->local_transport_amount[$index];
        //     $invoice_info->local_transport_remarks = $request->local_transport_remarks[$index];
        // }

        //     $invoice_info->save();

        // }
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
    public function generatePdf($id) {
        $data = [
            'tax'=> settings::all(),
            'invoice'=> invoice::find($id),
            'products'=> products::all(),
            'airlines'=> airlines::all(),
            ];
        $pdf = PDF::loadView('invoice',$data);
        // dd();
        $pdf->save('generated/pdf/invoice.pdf');
        $pdf->download('invoice.pdf');
        return "PDF GENERTATED";
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

