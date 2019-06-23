<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\airlines;
use App\airports;
use App\products;
use App\invoice;
use App\invoiceInfo;
use App\Flight;
use App\Passenger;
use Session;
use App\client;
use GuzzleHttp;
use App\settings;
use Carbon\Carbon;
use PDF;
use Mail;
use App\ClientSettings;
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
        foreach (invoice::all() as $invoice) {
            if($invoice->pending_amount < 0){
                $invoice->advance = 0 - $invoice->pending_amount;
                $invoice->pending_amount = 0;
                $invoice->save();
            }
            if ($invoice->pending_amount == 0) {
                $invoice->status = 1;
                $invoice->save();
            }
            if ($invoice->pending_amount > 0) {
                $invoice->status = 0;
                $invoice->save();
            }
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
        $invoice = invoice::where('invoice_no','CLDI0001')->get();
        if ($invoice->count()>0) {
            $latest = invoice::withTrashed()->orderBy('created_at','desc')->take(1)->get();
            $invoice_prev_no = $latest[0]->invoice_no;
            $invoice_no = 'CLDI000'.(substr($invoice_prev_no,4,7)+1);
        }
        else{
            $invoice_no = 'CLDI0001';
        }
        // $invoice_no = 'CLDI'. mt_rand(10000, 99999);
        // while (invoice::where('invoice_no',$invoice_no)->get()->count()>0) {
        //    $invoice_no = 'CLDI'. mt_rand(10000, 99999);
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
                                    ->with('date',$date)
                                    ->with('settings',ClientSettings::first());
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
        $invoice->receiver_name = strtoupper($client->first_name.' '.$client->last_name);
        $invoice->billing_address = strtoupper($request->billing_address);
        $invoice->invoice_date = $request->invoice_date;
        $invoice->invoice_no = $request->invoice_no;
        $invoice->discount = str_replace(',', '', $request->discount);
        $invoice->currency = $request->currency;
        $invoice->total = str_replace(',', '', $request->total);
        $invoice->discounted_total =str_replace(',', '', $request->total) - str_replace(',', '', $request->discount);
        $invoice->mail_sent = $date;
        $invoice->save();
        $tax = settings::all();
        if($tax[0]->enable == 'yes'){
            $invoice->VAT_percentage = $tax[0]->tax;
            $invoice->VAT_amount = ($tax[0]->tax)/100*(str_replace(',', '', $invoice->discounted_total));
        }

        $invoice->paid = 0;
        if($request->credit_amount != null){
            $invoice->credit = 1;
            $invoice->credit_amount = $invoice->credit_amount + $request->credit_amount;
            $invoice->paid = $invoice->paid + $request->credit_amount;
        }
        if($request->debit_amount != null){
            $invoice->debit = 1;
            $invoice->debit_amount = $invoice->debit_amount + $request->debit_amount;
            $invoice->paid = $invoice->paid + $request->debit_amount;
        }
        if($request->cash_amount != null){
            $invoice->cash = 1;
            $invoice->cash_amount = $invoice->cash_amount + $request->cash_amount;
            $invoice->paid = $invoice->paid + $request->cash_amount;
        }
        if($request->bank_amount != null){
            $invoice->bank = 1;
            $invoice->bank_amount = $invoice->bank_amount + $request->bank_amount;
            $invoice->paid = $invoice->paid + $request->bank_amount;
        }
        $invoice->save();
        $invoice->pending_amount =str_replace(',', '', $invoice->discounted_total ) + str_replace(',', '', $invoice->VAT_amount ) - str_replace(',', '', $invoice->paid );
        $invoice->save();
        $flight_counter=0;
        $visa_counter=0;
        $insurance_counter=0;
        $hotel_counter=0;
        $local_sight_sceen_counter=0;
        $local_transport_counter=0;
        $car_rental_counter=0;
        $other_facilities_counter=0;
        for ($k = 0; $k < count($request->service_name); $k++) {
            if ($request->service_name[$k]=='Flight') {
        //
            //     $invoice_info = new invoiceInfo;
            //             $invoice_info->invoice_id = $invoice->id;
            //             $invoice_info->receiver_name = $invoice->receiver_name;
            //             $invoice_info->service_name = 'Flight';

            //             $invoice_info->airline_name = $request->airline_name[$flight_counter];
            //             $invoice_info->source = $request->source[$flight_counter];
            //             $invoice_info->destination = $request->destination[$flight_counter];
            //             $invoice_info->date_of_travel = $request->date_of_travel[$flight_counter];
            //             $invoice_info->adult = $request->adult[$flight_counter];
            //             $invoice_info->adult_price = $request->adult_price[$flight_counter];
            //             if($request->child[$flight_counter]){
            //                 $invoice_info->child = $request->child[$flight_counter];
            //                 $invoice_info->child_price = $request->child_price[$flight_counter];
            //             }
            //             else{
            //                 $invoice_info->child = 0;
            //                 $invoice_info->child_price = 0;
            //             }

            //             if($request->infant[$flight_counter]){
            //                 $invoice_info->infant = $request->infant[$flight_counter];
            //                 $invoice_info->infant_price = $request->infant_price[$flight_counter];
            //             }
            //             else{
            //                 $invoice_info->infant = 0;
            //                 $invoice_info->infant_price = 0;
            //             }

            //             // $invoice_info->infant_dob = $request->infant_dob[$flight_counter];
            //             $invoice_info->flight_amount = $request->flight_amount[$flight_counter];
            //             $invoice_info->flight_remarks = $request->flight_remarks[$flight_counter];
            //             // $invoice_info->flight_quantity = $request->flight_quantity[$flight_counter];
            //             // $invoice_info->flight_price = $request->flight_price[$flight_counter];
            //             $invoice_info->save();
            //             $flight_counter++;
            //
        $flight = new Flight;
        $flight->invoice_id = $invoice->id;
        $flight->universal_pnr = strtoupper($request->universal_pnr[$flight_counter]);
        $flight->pnr = strtoupper($request->pnr[$flight_counter]);
        $flight->agency_pcc = strtoupper($request->agency_pcc[$flight_counter]);
        $flight->airline_ref = strtoupper($request->airline_ref[$flight_counter]);
        $flight->total_amount =  str_replace(',', '', $request->flight_amount[$flight_counter]);
        $flight->segment_one_from = strtoupper($request->segment_one_from[$flight_counter]);
        $flight->segment_two_from = strtoupper($request->segment_two_from[$flight_counter]);
        $flight->segment_one_to = strtoupper($request->segment_one_to[$flight_counter]);
        $flight->segment_two_to = strtoupper($request->segment_two_to[$flight_counter]);
        $flight->segment_one_carrier = strtoupper($request->segment_one_carrier[$flight_counter]);
        $flight->segment_two_carrier = strtoupper($request->segment_two_carrier[$flight_counter]);
        $flight->segment_one_flight = strtoupper($request->segment_one_flight[$flight_counter]);
        $flight->segment_two_flight = strtoupper($request->segment_two_flight[$flight_counter]);
        $flight->segment_one_class = strtoupper($request->segment_one_class[$flight_counter]);
        $flight->segment_two_class = strtoupper($request->segment_two_class[$flight_counter]);
        $flight->segment_one_departure = $request->segment_one_departure[$flight_counter];
        $flight->segment_two_departure = $request->segment_two_departure[$flight_counter];
        $flight->segment_one_arrival = $request->segment_one_arrival[$flight_counter];
        $flight->segment_two_arrival = $request->segment_two_arrival[$flight_counter];
        $flight->flight_remarks = strtoupper($request->flight_remarks[$flight_counter]);
        $flight->save();

        foreach($request->pax_type as $index=>$pax_type){
            if($request->verify[$index] == $flight->pnr )
            {
                $passenger = new Passenger;
                $passenger->flight_id = $flight->id;
                $passenger->pax_type = strtoupper($request->pax_type[$index]);
                $passenger->first_name = strtoupper($request->first_name[$index]);
                $passenger->last_name = strtoupper($request->last_name[$index]);
                $passenger->DOB = $request->DOB[$index];
                $passenger->segment_one_fare_cost = str_replace(',', '', $request->segment_one_fare_cost[$index]);
                $passenger->segment_two_fare_cost = str_replace(',', '', $request->segment_two_fare_cost[$index]);
                $passenger->segment_one_fare_sell = str_replace(',', '', $request->segment_one_fare_sell[$index]);
                $passenger->segment_two_fare_sell = str_replace(',', '', $request->segment_two_fare_sell[$index]);
                $passenger->save();
            }
        }
        $flight_counter++;
}

            if ($request->service_name[$k]=='Visa Services') {
                $invoice_info = new invoiceInfo;
                        $invoice_info->invoice_id = $invoice->id;
                        $invoice_info->receiver_name = $invoice->receiver_name;
                        $invoice_info->service_name = 'Visa Services';


                            $invoice_info->name_of_visa_applicant = strtoupper($request->name_of_visa_applicant[$visa_counter]);
                            $invoice_info->passport_origin = strtoupper($request->passport_origin[$visa_counter]);
                            $invoice_info->passport_member_dob = $request->passport_member_dob[$visa_counter];
                            $invoice_info->passport_no = strtoupper($request->passport_no[$visa_counter]);
                            $invoice_info->visa_country = strtoupper($request->visa_country[$visa_counter]);
                            $invoice_info->visa_type = strtoupper($request->visa_type[$visa_counter]);
                            $invoice_info->visa_charges = str_replace(',', '', $request->visa_charges[$visa_counter]);
                            $invoice_info->service_charge = str_replace(',', '', $request->service_charge[$visa_counter]);
                            $invoice_info->visa_amount = str_replace(',', '', $request->visa_amount[$visa_counter]);

                        $invoice_info->save();
                        $visa_counter++;
            }

            if ($request->service_name[$k]=='Insurance') {
                $invoice_info = new invoiceInfo;
                        $invoice_info->invoice_id = $invoice->id;
                        $invoice_info->receiver_name = $invoice->receiver_name;
                        $invoice_info->service_name = 'Insurance';


                            $invoice_info->name_of_insurance_applicant = strtoupper($request->name_of_insurance_applicant[$insurance_counter]);
                            $invoice_info->name_of_insurance_company = strtoupper($request->name_of_insurance_company[$insurance_counter]);
                            $invoice_info->insurance_amount = str_replace(',', '', $request->insurance_amount[$insurance_counter]);
                            $invoice_info->insurance_remarks = strtoupper($request->insurance_remarks[$insurance_counter]);

                        $invoice_info->save();
                        $insurance_counter++;
            }

            if ($request->service_name[$k]=='Hotel') {
                $invoice_info = new invoiceInfo;
                        $invoice_info->invoice_id = $invoice->id;
                        $invoice_info->receiver_name = $invoice->receiver_name;
                        $invoice_info->service_name = 'Hotel';


                            $invoice_info->hotel_city = strtoupper($request->hotel_city[$hotel_counter]);
                            $invoice_info->hotel_country = strtoupper($request->hotel_country[$hotel_counter]);
                            $invoice_info->hotel_name = strtoupper($request->hotel_name[$hotel_counter]);
                            $invoice_info->check_in_date = $request->check_in_date[$hotel_counter];
                            $invoice_info->check_out_date = $request->check_out_date[$hotel_counter];
                            $invoice_info->no_of_children = $request->no_of_children[$hotel_counter];
                            $invoice_info->no_of_rooms = $request->no_of_rooms[$hotel_counter];
                            $invoice_info->hotel_amount = str_replace(',', '', $request->hotel_amount[$hotel_counter]);

                        $invoice_info->save();
                        $hotel_counter++;
            }

            if ($request->service_name[$k]=='Local Sight Sceen') {
                $invoice_info = new invoiceInfo;
                        $invoice_info->invoice_id = $invoice->id;
                        $invoice_info->receiver_name = strtoupper($invoice->receiver_name);
                        $invoice_info->service_name = 'Local Sight Sceen';


                            $invoice_info->local_sight_sceen_amount = str_replace(',', '', $request->local_sight_sceen_amount[$local_sight_sceen_counter]);
                            $invoice_info->local_sight_sceen_remarks = strtoupper($request->local_sight_sceen_remarks[$local_sight_sceen_counter]);

                        $invoice_info->save();
                        $local_sight_sceen_counter++;
            }

            if ($request->service_name[$k]=='Local Transport') {
                $invoice_info = new invoiceInfo;
                        $invoice_info->invoice_id = $invoice->id;
                        $invoice_info->receiver_name = $invoice->receiver_name;
                        $invoice_info->service_name = 'Local Transport';


                            $invoice_info->local_transport_amount = str_replace(',', '', $request->local_transport_amount[$local_transport_counter]);
                            $invoice_info->local_transport_remarks = strtoupper($request->local_transport_remarks[$local_transport_counter]);

                        $invoice_info->save();
                        $local_transport_counter++;
            }

            if ($request->service_name[$k]=='Car Rental') {
                $invoice_info = new invoiceInfo;
                        $invoice_info->invoice_id = $invoice->id;
                        $invoice_info->receiver_name = $invoice->receiver_name;
                        $invoice_info->service_name = 'Car Rental';


                            $invoice_info->car_rental_amount = str_replace(',', '', $request->car_rental_amount[$car_rental_counter]);
                            $invoice_info->car_rental_remarks = strtoupper($request->car_rental_remarks[$car_rental_counter]);

                        $invoice_info->save();
                        $car_rental_counter++;
            }

            if ($request->service_name[$k]=='Other Facilities') {
                $invoice_info = new invoiceInfo;
                        $invoice_info->invoice_id = $invoice->id;
                        $invoice_info->receiver_name = $invoice->receiver_name;
                        $invoice_info->service_name = 'Other Facilities';


                            $invoice_info->other_facilities_amount = str_replace(',', '', $request->other_facilities_amount[$other_facilities_counter]);
                            $invoice_info->other_facilities_remarks = strtoupper($request->other_facilities_remarks[$other_facilities_counter]);

                        $invoice_info->save();
                        $other_facilities_counter++;
            }
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

    public function test($id)
    {
        return view('test')->with('invoice',invoice::find($id))
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
        $dt = Carbon::now();
        $dt->timezone('Asia/Kolkata');
        $date_today = $dt->timezone('Europe/London');
        $date = $date_today->toDateString();
        $invoice = invoice::find($id);
        $client = client::find($invoice->client_id);
        return view('invoice.edit')->with('invoice',$invoice)
                                        ->with('products',products::all())
                                        ->with('airlines',airlines::all())
                                        ->with('client',$client)
                                        ->with('settings',ClientSettings::first())
                                        ->with('date',$date);


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
        $invoice->discount = $request->discount;
        // dd($invoice->discount);
        $invoice->currency = $request->currency;
        $invoice->total = $request->total;
        $invoice->discounted_total =$request->total - $request->discount;

        $invoice->save();
        $invoice->pending_amount = $invoice->discounted_total + $invoice->VAT_amount - $invoice->paid;
        $invoice->save();
        foreach ($invoice->invoiceInfo as $info) {
            $info->delete();
        }
        foreach($invoice->flights as $flight){
            foreach($flight->passengers as $passenger){
                $passenger->delete();
            }
            $flight->delete();
        }

        $flight_counter=0;
        $visa_counter=0;
        $insurance_counter=0;
        $hotel_counter=0;
        $local_sight_sceen_counter=0;
        $local_transport_counter=0;
        $car_rental_counter=0;
        $other_facilities_counter=0;
        for ($k = 0; $k < count($request->service_name); $k++) {
            if ($request->service_name[$k]=='Flight') {
                $flight = new Flight;
                $flight->invoice_id = $invoice->id;
                $flight->universal_pnr = strtoupper($request->universal_pnr[$flight_counter]);
                $flight->pnr = strtoupper($request->pnr[$flight_counter]);
                $flight->agency_pcc = strtoupper($request->agency_pcc[$flight_counter]);
                $flight->airline_ref = strtoupper($request->airline_ref[$flight_counter]);
                $flight->total_amount = str_replace(',', '', $request->flight_amount[$flight_counter]);
                $flight->segment_one_from = strtoupper($request->segment_one_from[$flight_counter]);
                $flight->segment_two_from = strtoupper($request->segment_two_from[$flight_counter]);
                $flight->segment_one_to = strtoupper($request->segment_one_to[$flight_counter]);
                $flight->segment_two_to = strtoupper($request->segment_two_to[$flight_counter]);
                $flight->segment_one_carrier = strtoupper($request->segment_one_carrier[$flight_counter]);
                $flight->segment_two_carrier = strtoupper($request->segment_two_carrier[$flight_counter]);
                $flight->segment_one_flight = strtoupper($request->segment_one_flight[$flight_counter]);
                $flight->segment_two_flight = strtoupper($request->segment_two_flight[$flight_counter]);
                $flight->segment_one_class = strtoupper($request->segment_one_class[$flight_counter]);
                $flight->segment_two_class = strtoupper($request->segment_two_class[$flight_counter]);
                $flight->segment_one_departure = $request->segment_one_departure[$flight_counter];
                $flight->segment_two_departure = $request->segment_two_departure[$flight_counter];
                $flight->segment_one_arrival = $request->segment_one_arrival[$flight_counter];
                $flight->segment_two_arrival = $request->segment_two_arrival[$flight_counter];
                $flight->flight_remarks = strtoupper($request->flight_remarks[$flight_counter]);
                $flight->save();

            foreach($request->pax_type as $index=>$pax_type){
                if($request->verify[$index] == $flight->pnr )
                {
                    $passenger = new Passenger;
                    $passenger->flight_id = $flight->id;
                    $passenger->pax_type = strtoupper($request->pax_type[$index]);
                    $passenger->first_name = strtoupper($request->first_name[$index]);
                    $passenger->last_name = strtoupper($request->last_name[$index]);
                    $passenger->DOB = $request->DOB[$index];
                    $passenger->segment_one_fare_cost = str_replace(',', '', $request->segment_one_fare_cost[$index]);
                    $passenger->segment_two_fare_cost = str_replace(',', '', $request->segment_two_fare_cost[$index]);
                    $passenger->segment_one_fare_sell = str_replace(',', '', $request->segment_one_fare_sell[$index]);
                    $passenger->segment_two_fare_sell = str_replace(',', '', $request->segment_two_fare_sell[$index]);
                    $passenger->save();
                }
        }
                $flight_counter++;
        }
            if ($request->service_name[$k]=='Visa Services') {
                $invoice_info = new invoiceInfo;
                        $invoice_info->invoice_id = $invoice->id;
                        $invoice_info->receiver_name = $invoice->receiver_name;
                        $invoice_info->service_name = 'Visa Services';


                            $invoice_info->name_of_visa_applicant = strtoupper($request->name_of_visa_applicant[$visa_counter]);
                            $invoice_info->passport_origin = strtoupper($request->passport_origin[$visa_counter]);
                            $invoice_info->passport_member_dob = $request->passport_member_dob[$visa_counter];
                            $invoice_info->passport_no = strtoupper($request->passport_no[$visa_counter]);
                            $invoice_info->visa_country = strtoupper($request->visa_country[$visa_counter]);
                            $invoice_info->visa_type = strtoupper($request->visa_type[$visa_counter]);
                            $invoice_info->visa_charges = str_replace(',', '', $request->visa_charges[$visa_counter]);
                            $invoice_info->service_charge = str_replace(',', '', $request->service_charge[$visa_counter]);
                            $invoice_info->visa_amount = str_replace(',', '', $request->visa_amount[$visa_counter]);

                        $invoice_info->save();
                        $visa_counter++;
            }

            if ($request->service_name[$k]=='Insurance') {
                $invoice_info = new invoiceInfo;
                        $invoice_info->invoice_id = $invoice->id;
                        $invoice_info->receiver_name = $invoice->receiver_name;
                        $invoice_info->service_name = 'Insurance';


                            $invoice_info->name_of_insurance_applicant = strtoupper($request->name_of_insurance_applicant[$insurance_counter]);
                            $invoice_info->insurance_amount = str_replace(',', '', $request->insurance_amount[$insurance_counter]);
                            $invoice_info->insurance_remarks = strtoupper($request->insurance_remarks[$insurance_counter]);

                        $invoice_info->save();
                        $insurance_counter++;
            }

            if ($request->service_name[$k]=='Hotel') {
                $invoice_info = new invoiceInfo;
                        $invoice_info->invoice_id = $invoice->id;
                        $invoice_info->receiver_name = $invoice->receiver_name;
                        $invoice_info->service_name = 'Hotel';


                            $invoice_info->hotel_city = strtoupper($request->hotel_city[$hotel_counter]);
                            $invoice_info->hotel_country = strtoupper($request->hotel_country[$hotel_counter]);
                            $invoice_info->hotel_name = strtoupper($request->hotel_name[$hotel_counter]);
                            $invoice_info->check_in_date = $request->check_in_date[$hotel_counter];
                            $invoice_info->check_out_date = $request->check_out_date[$hotel_counter];
                            $invoice_info->no_of_children = $request->no_of_children[$hotel_counter];
                            $invoice_info->no_of_rooms = $request->no_of_rooms[$hotel_counter];
                            $invoice_info->hotel_amount = str_replace(',', '', $request->hotel_amount[$hotel_counter]);

                        $invoice_info->save();
                        $hotel_counter++;
            }

            if ($request->service_name[$k]=='Local Sight Sceen') {
                $invoice_info = new invoiceInfo;
                        $invoice_info->invoice_id = $invoice->id;
                        $invoice_info->receiver_name = $invoice->receiver_name;
                        $invoice_info->service_name = 'Local Sight Sceen';


                            $invoice_info->local_sight_sceen_amount = str_replace(',', '', $request->local_sight_sceen_amount[$local_sight_sceen_counter]);
                            $invoice_info->local_sight_sceen_remarks = strtoupper($request->local_sight_sceen_remarks[$local_sight_sceen_counter]);

                        $invoice_info->save();
                        $local_sight_sceen_counter++;
            }

            if ($request->service_name[$k]=='Local Transport') {
                $invoice_info = new invoiceInfo;
                        $invoice_info->invoice_id = $invoice->id;
                        $invoice_info->receiver_name = $invoice->receiver_name;
                        $invoice_info->service_name = 'Local Transport';


                            $invoice_info->local_transport_amount = str_replace(',', '', $request->local_transport_amount[$local_transport_counter]);
                            $invoice_info->local_transport_remarks = strtoupper($request->local_transport_remarks[$local_transport_counter]);

                        $invoice_info->save();
                        $local_transport_counter++;
            }

            if ($request->service_name[$k]=='Car Rental') {
                $invoice_info = new invoiceInfo;
                        $invoice_info->invoice_id = $invoice->id;
                        $invoice_info->receiver_name = $invoice->receiver_name;
                        $invoice_info->service_name = 'Car Rental';


                            $invoice_info->car_rental_amount = str_replace(',', '', $request->car_rental_amount[$car_rental_counter]);
                            $invoice_info->car_rental_remarks = strtoupper($request->car_rental_remarks[$car_rental_counter]);

                        $invoice_info->save();
                        $car_rental_counter++;
            }

            if ($request->service_name[$k]=='Other Facilities') {
                $invoice_info = new invoiceInfo;
                        $invoice_info->invoice_id = $invoice->id;
                        $invoice_info->receiver_name = $invoice->receiver_name;
                        $invoice_info->service_name = 'Other Facilities';


                            $invoice_info->other_facilities_amount = str_replace(',', '', $request->other_facilities_amount[$other_facilities_counter]);
                            $invoice_info->other_facilities_remarks = strtoupper($request->other_facilities_remarks[$other_facilities_counter]);

                        $invoice_info->save();
                        $other_facilities_counter++;
            }
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

        if ($invoice->status == 0) {
            // $invoice->invoice_no = dd(substr($invoice->invoice_no,0,3).'C');
            $invoice->delete();
            Session::flash('success','Invoice Canceled Successfully');
            return redirect()->back()->with('invoices',invoice::all());
        }
        else{
            Session::flash('warning',"This Invoice is already Paid. You Can't Cancel Now!!");
            return redirect()->back();
        }
    }
    public function generatePdf($id) {
        $data = [
            'tax'=> settings::all(),
            'invoice'=> invoice::find($id),
            'products'=> products::all(),
            'airlines'=> airlines::all(),
            ];
        $pdf = PDF::loadView('invoicePrint',$data);
        return $pdf->setPaper('a4')->stream('invoice.pdf');

    }

    public function AirlineSearch(Request $request){
        if($request->ajax()){
            $output="";
            $airline= airlines::where('name','LIKE','%'.$request->search."%")->get();
            if($airline){
                    foreach ($airline as $key => $product) {
                        $output.='<a><option onClick="AirlineAssign(this)" value="'.$product->name.'">'.$product->name.'</option></a>';
                    }
                return Response($output);
            }
        }
    }

    public function AirportSearch(Request $request){
        if($request->ajax()){
            $output="";
            $airline= airports::where('name','LIKE','%'.$request->search."%")->get();
            if($airline){
                    foreach ($airline as $key => $product) {
                        $output.='<a><option onClick="AirportAssign(this)" value="'.$product->name.'">'.$product->name.'</option></a>';
                    }
                return Response($output);
            }
        }
    }

    public function AirportArrivalSearch(Request $request){
        if($request->ajax()){
            $output="";
            $airline= airports::where('name','LIKE','%'.$request->search."%")->get();
            if($airline){
                    foreach ($airline as $key => $product) {
                        $output.='<a><option onClick="AirportArrivalAssign(this)" value="'.$product->name.'">'.$product->name.'</option></a>';
                    }
                return Response($output);
            }
        }
    }

    public function canceled(){
        $invoices = invoice::onlyTrashed()->get();
        return view('invoice.canceled')->with('invoices',$invoices)
                                    ->with('tax',settings::all());

    }

    public function retrieve($id){
        $invoice = invoice::withTrashed()->where('id',$id)->first();
        $invoice->restore();
        Session::flash('success','Invoice Retreived');
        return redirect()->route('invoice')->with('invoices',invoice::all())
                                    ->with('tax',settings::all());

    }

    public function kill($id){
        $invoice = invoice::withTrashed()->where('id',$id)->first();
        $invoice->forceDelete();
        Session::flash('success','Invoice Deleted Permanently');
        return redirect()->back();

    }

    public function pay($id){
        $invoice = invoice::find($id);
        if ($invoice->status == 0) {
            return view('invoice.pay')->with('invoice',$invoice);
        }
        else{
            Session::flash('warning',"This Invoice is already Paid. You Can't Pay Now!!");
            return redirect()->back();
        }

    }

    public function payy(Request $request,$id){
        $invoice = invoice::find($id);
        if($request->credit_amount != null){
            $invoice->credit = 1;
            $invoice->credit_amount = $invoice->credit_amount + $request->credit_amount;
            $invoice->paid = $invoice->paid + $request->credit_amount;
        }
        if($request->debit_amount != null){
            $invoice->debit = 1;
            $invoice->debit_amount = $invoice->debit_amount + $request->debit_amount;
            $invoice->paid = $invoice->paid + $request->debit_amount;
        }
        if($request->cash_amount != null){
            $invoice->cash = 1;
            $invoice->cash_amount = $invoice->cash_amount + $request->cash_amount;
            $invoice->paid = $invoice->paid + $request->cash_amount;
        }
        if($request->bank_amount != null){
            $invoice->bank = 1;
            $invoice->bank_amount = $invoice->bank_amount + $request->bank_amount;
            $invoice->paid = $invoice->paid + $request->bank_amount;
        }
        $invoice->save();
        $invoice->pending_amount = $invoice->discounted_total + $invoice->VAT_amount - $invoice->paid;
        $invoice->save();
        return redirect()->route('invoice')->with('invoices',invoice::all())
                                            ->with('tax',settings::all());

    }

    public function reminder($id){
        $invoice = invoice::find($id);
        if ($invoice->status == 0) {
            Mail::to($invoice->client->email)->send(new \App\Mail\invoiceMail);
            $invoice->mail_sent = Carbon::now()->timezone('Europe/London')->toDateString();
            $invoice->save();
            Session::flash('success','Sent!!');
            return redirect()->back();
        }
        else{
            Session::flash('warning',"This Invoice is already Paid. You Can't Send Reminder Now!!");
            return redirect()->back();
        }

    }
    public function AirlineSearchTwo(Request $request){
        if($request->ajax()){
            $output="";
            $airline= airlines::where('name','LIKE','%'.$request->search."%")->get();
            if($airline){
                    foreach ($airline as $key => $product) {
                        $output.='<a><option onClick="AirlineAssignTwo(this)" value="'.$product->name.'">'.$product->name.'</option></a>';
                    }
                return Response($output);
            }
        }
    }

    public function AirportSearchTwo(Request $request){
        if($request->ajax()){
            $output="";
            $airline= airports::where('name','LIKE','%'.$request->search."%")->get();
            if($airline){
                    foreach ($airline as $key => $product) {
                        $output.='<a><option onClick="AirportAssignTwo(this)" value="'.$product->name.'">'.$product->name.'</option></a>';
                    }
                return Response($output);
            }
        }
    }

    public function AirportArrivalSearchTwo(Request $request){
        if($request->ajax()){
            $output="";
            $airline= airports::where('name','LIKE','%'.$request->search."%")->get();
            if($airline){
                    foreach ($airline as $key => $product) {
                        $output.='<a><option onClick="AirportArrivalAssignTwo(this)" value="'.$product->name.'">'.$product->name.'</option></a>';
                    }
                return Response($output);
            }
        }
    }


}
