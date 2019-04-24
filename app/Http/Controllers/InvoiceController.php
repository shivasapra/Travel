<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\airlines;
use App\airports;
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
        foreach (invoice::all() as $invoice) {
            if ($invoice->pending_amount == 0) {
                $invoice->status = 1;
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
        $invoice->total = $request->total;
        $invoice->discounted_total =$request->total - $request->discount;
        $invoice->mail_sent = $date;
        $invoice->save();
        $tax = settings::all();
        if($tax[0]->enable == 'yes'){
            $invoice->VAT_percentage = $tax[0]->tax;
            $invoice->VAT_amount = ($tax[0]->tax)/100*($invoice->discounted_total);
        }
        
        $invoice->paid = 0;
        if($request->credit != '0'){
            $invoice->credit = 1;
            $invoice->credit_amount = $request->credit_amount;
            $invoice->paid = $invoice->paid + $request->credit_amount;
        }
        else{
            $invoice->credit = 0;
            $invoice->credit_amount = $request->credit_amount;
            $invoice->paid = $invoice->paid + $request->credit_amount;
        }
        if($request->debit != '0'){
            $invoice->debit = 1;
            $invoice->debit_amount = $request->debit_amount;
            $invoice->paid = $invoice->paid + $request->debit_amount;
        }
        else{
            $invoice->debit = 0;
            $invoice->debit_amount = $request->debit_amount;
            $invoice->paid = $invoice->paid + $request->debit_amount;
        }
        if($request->cash != '0'){
            $invoice->cash = 1;
            $invoice->cash_amount = $request->cash_amount;
            $invoice->paid = $invoice->paid + $request->cash_amount;
        }
        else{
            $invoice->cash = 0;
            $invoice->cash_amount = $request->cash_amount;
            $invoice->paid = $invoice->paid + $request->cash_amount;
        }
        if($request->bank != '0'){
            $invoice->bank = 1;
            $invoice->bank_amount = $request->bank_amount;
            $invoice->paid = $invoice->paid + $request->bank_amount;
        }
        else{
            $invoice->bank = 0;
            $invoice->bank_amount = $request->bank_amount;
            $invoice->paid = $invoice->paid + $request->bank_amount;
        }
        $invoice->save();
        $invoice->pending_amount = $invoice->discounted_total + $invoice->VAT_amount - $invoice->paid;
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
                $invoice_info = new invoiceInfo;
                        $invoice_info->invoice_id = $invoice->id;
                        $invoice_info->service_name = 'Flight';

                        $invoice_info->airline_name = $request->airline_name[$flight_counter];
                        $invoice_info->source = $request->source[$flight_counter];
                        $invoice_info->destination = $request->destination[$flight_counter];
                        $invoice_info->date_of_travel = $request->date_of_travel[$flight_counter];
                        $invoice_info->adult = $request->adult[$flight_counter];
                        $invoice_info->adult_price = $request->adult_price[$flight_counter];
                        if($request->child[$flight_counter]){
                            $invoice_info->child = $request->child[$flight_counter];
                            $invoice_info->child_price = $request->child_price[$flight_counter];
                        }
                        else{
                            $invoice_info->child = 0;
                            $invoice_info->child_price = 0;
                        }

                        if($request->infant[$flight_counter]){
                            $invoice_info->infant = $request->infant[$flight_counter];
                            $invoice_info->infant_price = $request->infant_price[$flight_counter];
                        }
                        else{
                            $invoice_info->infant = 0;
                            $invoice_info->infant_price = 0;
                        }

                        // $invoice_info->infant_dob = $request->infant_dob[$flight_counter];
                        $invoice_info->flight_amount = $request->flight_amount[$flight_counter];
                        $invoice_info->flight_remarks = $request->flight_remarks[$flight_counter];
                        // $invoice_info->flight_quantity = $request->flight_quantity[$flight_counter];
                        // $invoice_info->flight_price = $request->flight_price[$flight_counter];
                        $invoice_info->save();
                        $flight_counter++;
            }

            if ($request->service_name[$k]=='Visa Services') {
                $invoice_info = new invoiceInfo;
                        $invoice_info->invoice_id = $invoice->id;
                        $invoice_info->service_name = 'Visa Services';


                            $invoice_info->name_of_visa_applicant = $request->name_of_visa_applicant[$visa_counter];
                            $invoice_info->passport_origin = $request->passport_origin[$visa_counter];
                            $invoice_info->passport_member_dob = $request->passport_member_dob[$visa_counter];
                            $invoice_info->passport_no = $request->passport_no[$visa_counter];
                            $invoice_info->visa_country = $request->visa_country[$visa_counter];
                            $invoice_info->visa_type = $request->visa_type[$visa_counter];
                            $invoice_info->visa_charges = $request->visa_charges[$visa_counter];
                            $invoice_info->service_charge = $request->service_charge[$visa_counter];
                            $invoice_info->visa_amount = $request->visa_amount[$visa_counter];

                        $invoice_info->save();
                        $visa_counter++;
            }

            if ($request->service_name[$k]=='Insurance') {
                $invoice_info = new invoiceInfo;
                        $invoice_info->invoice_id = $invoice->id;
                        $invoice_info->service_name = 'Insurance';


                            $invoice_info->name_of_insurance_applicant = $request->name_of_insurance_applicant[$insurance_counter];
                            $invoice_info->insurance_amount = $request->insurance_amount[$insurance_counter];
                            $invoice_info->insurance_remarks = $request->insurance_remarks[$insurance_counter];

                        $invoice_info->save();
                        $insurance_counter++;
            }

            if ($request->service_name[$k]=='Hotel') {
                $invoice_info = new invoiceInfo;
                        $invoice_info->invoice_id = $invoice->id;
                        $invoice_info->service_name = 'Hotel';


                            $invoice_info->hotel_city = $request->hotel_city[$hotel_counter];
                            $invoice_info->hotel_country = $request->hotel_country[$hotel_counter];
                            $invoice_info->hotel_name = $request->hotel_name[$hotel_counter];
                            $invoice_info->check_in_date = $request->check_in_date[$hotel_counter];
                            $invoice_info->check_out_date = $request->check_out_date[$hotel_counter];
                            $invoice_info->no_of_children = $request->no_of_children[$hotel_counter];
                            $invoice_info->no_of_rooms = $request->no_of_rooms[$hotel_counter];
                            $invoice_info->hotel_amount = $request->hotel_amount[$hotel_counter];

                        $invoice_info->save();
                        $hotel_counter++;
            }

            if ($request->service_name[$k]=='Local Sight Sceen') {
                $invoice_info = new invoiceInfo;
                        $invoice_info->invoice_id = $invoice->id;
                        $invoice_info->service_name = 'Local Sight Sceen';


                            $invoice_info->local_sight_sceen_amount = $request->local_sight_sceen_amount[$local_sight_sceen_counter];
                            $invoice_info->local_sight_sceen_remarks = $request->local_sight_sceen_remarks[$local_sight_sceen_counter];

                        $invoice_info->save();
                        $local_sight_sceen_counter++;
            }

            if ($request->service_name[$k]=='Local Transport') {
                $invoice_info = new invoiceInfo;
                        $invoice_info->invoice_id = $invoice->id;
                        $invoice_info->service_name = 'Local Transport';


                            $invoice_info->local_transport_amount = $request->local_transport_amount[$local_transport_counter];
                            $invoice_info->local_transport_remarks = $request->local_transport_remarks[$local_transport_counter];

                        $invoice_info->save();
                        $local_transport_counter++;
            }

            if ($request->service_name[$k]=='Car Rental') {
                $invoice_info = new invoiceInfo;
                        $invoice_info->invoice_id = $invoice->id;
                        $invoice_info->service_name = 'Car Rental';


                            $invoice_info->car_rental_amount = $request->car_rental_amount[$car_rental_counter];
                            $invoice_info->car_rental_remarks = $request->car_rental_remarks[$car_rental_counter];

                        $invoice_info->save();
                        $car_rental_counter++;
            }

            if ($request->service_name[$k]=='Other Facilities') {
                $invoice_info = new invoiceInfo;
                        $invoice_info->invoice_id = $invoice->id;
                        $invoice_info->service_name = 'Other Facilities';


                            $invoice_info->other_facilities_amount = $request->other_facilities_amount[$other_facilities_counter];
                            $invoice_info->other_facilities_remarks = $request->other_facilities_remarks[$other_facilities_counter];

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

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $invoice = invoice::find($id);
        $client = client::find($invoice->client_id);
        return view('invoice.edit')->with('invoice',$invoice)
                                    ->with('products',products::all())
                                    ->with('airlines',airlines::all())
                                    ->with('client',$client);

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
        $invoice->currency = $request->currency;
        $invoice->total = $request->total;
        $invoice->discounted_total =$request->total - $request->discount;
        $invoice->paid = 0;
        if($request->credit != '0'){
            $invoice->credit = 1;
            $invoice->credit_amount = $request->credit_amount;
            $invoice->paid = $invoice->paid + $request->credit_amount;
        }
        else{
            $invoice->credit = 0;
            $invoice->credit_amount = $request->credit_amount;
            $invoice->paid = $invoice->paid + $request->credit_amount;
        }
        if($request->debit != '0'){
            $invoice->debit = 1;
            $invoice->debit_amount = $request->debit_amount;
            $invoice->paid = $invoice->paid + $request->debit_amount;
        }
        else{
            $invoice->debit = 0;
            $invoice->debit_amount = $request->debit_amount;
            $invoice->paid = $invoice->paid + $request->debit_amount;
        }
        if($request->cash != '0'){
            $invoice->cash = 1;
            $invoice->cash_amount = $request->cash_amount;
            $invoice->paid = $invoice->paid + $request->cash_amount;
        }
        else{
            $invoice->cash = 0;
            $invoice->cash_amount = $request->cash_amount;
            $invoice->paid = $invoice->paid + $request->cash_amount;
        }
        if($request->bank != '0'){
            $invoice->bank = 1;
            $invoice->bank_amount = $request->bank_amount;
            $invoice->paid = $invoice->paid + $request->bank_amount;
        }
        else{
            $invoice->bank = 0;
            $invoice->bank_amount = $request->bank_amount;
            $invoice->paid = $invoice->paid + $request->bank_amount;
        }
        $invoice->save();
        $invoice->pending_amount = $invoice->discounted_total + $invoice->VAT_amount - $invoice->paid;
        $invoice->save();
        foreach ($invoice->invoiceInfo as $info) {
            $info->delete();
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
                $invoice_info = new invoiceInfo;
                        $invoice_info->invoice_id = $invoice->id;
                        $invoice_info->service_name = 'Flight';

                        $invoice_info->airline_name = $request->airline_name[$flight_counter];
                        $invoice_info->source = $request->source[$flight_counter];
                        $invoice_info->destination = $request->destination[$flight_counter];
                        $invoice_info->date_of_travel = $request->date_of_travel[$flight_counter];
                        $invoice_info->adult = $request->adult[$flight_counter];
                        $invoice_info->adult_price = $request->adult_price[$flight_counter];
                        $invoice_info->child = $request->child[$flight_counter];
                        $invoice_info->child_price = $request->child_price[$flight_counter];
                        $invoice_info->infant = $request->infant[$flight_counter];
                        $invoice_info->infant_price = $request->infant_price[$flight_counter];
                        $invoice_info->flight_amount = $request->flight_amount[$flight_counter];
                        $invoice_info->flight_remarks = $request->flight_remarks[$flight_counter];
                        $invoice_info->save();
                        $flight_counter++;
            }

            if ($request->service_name[$k]=='Visa Services') {
                $invoice_info = new invoiceInfo;
                        $invoice_info->invoice_id = $invoice->id;
                        $invoice_info->service_name = 'Visa Services';


                            $invoice_info->name_of_visa_applicant = $request->name_of_visa_applicant[$visa_counter];
                            $invoice_info->passport_origin = $request->passport_origin[$visa_counter];
                            $invoice_info->passport_member_dob = $request->passport_member_dob[$visa_counter];
                            $invoice_info->passport_no = $request->passport_no[$visa_counter];
                            $invoice_info->visa_country = $request->visa_country[$visa_counter];
                            $invoice_info->visa_type = $request->visa_type[$visa_counter];
                            $invoice_info->visa_charges = $request->visa_charges[$visa_counter];
                            $invoice_info->service_charge = $request->service_charge[$visa_counter];
                            $invoice_info->visa_amount = $request->visa_amount[$visa_counter];

                        $invoice_info->save();
                        $visa_counter++;
            }

            if ($request->service_name[$k]=='Insurance') {
                $invoice_info = new invoiceInfo;
                        $invoice_info->invoice_id = $invoice->id;
                        $invoice_info->service_name = 'Insurance';


                            $invoice_info->name_of_insurance_applicant = $request->name_of_insurance_applicant[$insurance_counter];
                            $invoice_info->insurance_amount = $request->insurance_amount[$insurance_counter];
                            $invoice_info->insurance_remarks = $request->insurance_remarks[$insurance_counter];

                        $invoice_info->save();
                        $insurance_counter++;
            }

            if ($request->service_name[$k]=='Hotel') {
                $invoice_info = new invoiceInfo;
                        $invoice_info->invoice_id = $invoice->id;
                        $invoice_info->service_name = 'Hotel';


                            $invoice_info->hotel_city = $request->hotel_city[$hotel_counter];
                            $invoice_info->hotel_country = $request->hotel_country[$hotel_counter];
                            $invoice_info->hotel_name = $request->hotel_name[$hotel_counter];
                            $invoice_info->check_in_date = $request->check_in_date[$hotel_counter];
                            $invoice_info->check_out_date = $request->check_out_date[$hotel_counter];
                            $invoice_info->no_of_children = $request->no_of_children[$hotel_counter];
                            $invoice_info->no_of_rooms = $request->no_of_rooms[$hotel_counter];
                            $invoice_info->hotel_amount = $request->hotel_amount[$hotel_counter];

                        $invoice_info->save();
                        $hotel_counter++;
            }

            if ($request->service_name[$k]=='Local Sight Sceen') {
                $invoice_info = new invoiceInfo;
                        $invoice_info->invoice_id = $invoice->id;
                        $invoice_info->service_name = 'Local Sight Sceen';


                            $invoice_info->local_sight_sceen_amount = $request->local_sight_sceen_amount[$local_sight_sceen_counter];
                            $invoice_info->local_sight_sceen_remarks = $request->local_sight_sceen_remarks[$local_sight_sceen_counter];

                        $invoice_info->save();
                        $local_sight_sceen_counter++;
            }

            if ($request->service_name[$k]=='Local Transport') {
                $invoice_info = new invoiceInfo;
                        $invoice_info->invoice_id = $invoice->id;
                        $invoice_info->service_name = 'Local Transport';


                            $invoice_info->local_transport_amount = $request->local_transport_amount[$local_transport_counter];
                            $invoice_info->local_transport_remarks = $request->local_transport_remarks[$local_transport_counter];

                        $invoice_info->save();
                        $local_transport_counter++;
            }

            if ($request->service_name[$k]=='Car Rental') {
                $invoice_info = new invoiceInfo;
                        $invoice_info->invoice_id = $invoice->id;
                        $invoice_info->service_name = 'Car Rental';


                            $invoice_info->car_rental_amount = $request->car_rental_amount[$car_rental_counter];
                            $invoice_info->car_rental_remarks = $request->car_rental_remarks[$car_rental_counter];

                        $invoice_info->save();
                        $car_rental_counter++;
            }

            if ($request->service_name[$k]=='Other Facilities') {
                $invoice_info = new invoiceInfo;
                        $invoice_info->invoice_id = $invoice->id;
                        $invoice_info->service_name = 'Other Facilities';


                            $invoice_info->other_facilities_amount = $request->other_facilities_amount[$other_facilities_counter];
                            $invoice_info->other_facilities_remarks = $request->other_facilities_remarks[$other_facilities_counter];

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
        $invoice->delete();
        Session::flash('success','Invoice Canceled Successfully');
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
        return $pdf->save('generated/pdf/invoice.pdf')->stream('invoice.pdf');
        //  $pdf->download('invoice.pdf');
        
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
        return view('invoice.pay')->with('invoice',$invoice);

    }

    public function payy(Request $request,$id){
        $invoice = invoice::find($id);
        $invoice->paid = 0;
        if($request->credit != '0'){
            $invoice->credit = 1;
            $invoice->credit_amount = $request->credit_amount;
            $invoice->paid = $invoice->paid + $request->credit_amount;
        }
        else{
            $invoice->credit = 0;
            $invoice->credit_amount = $request->credit_amount;
            $invoice->paid = $invoice->paid + $request->credit_amount;
        }
        if($request->debit != '0'){
            $invoice->debit = 1;
            $invoice->debit_amount = $request->debit_amount;
            $invoice->paid = $invoice->paid + $request->debit_amount;
        }
        else{
            $invoice->debit = 0;
            $invoice->debit_amount = $request->debit_amount;
            $invoice->paid = $invoice->paid + $request->debit_amount;
        }
        if($request->cash != '0'){
            $invoice->cash = 1;
            $invoice->cash_amount = $request->cash_amount;
            $invoice->paid = $invoice->paid + $request->cash_amount;
        }
        else{
            $invoice->cash = 0;
            $invoice->cash_amount = $request->cash_amount;
            $invoice->paid = $invoice->paid + $request->cash_amount;
        }
        if($request->bank != '0'){
            $invoice->bank = 1;
            $invoice->bank_amount = $request->bank_amount;
            $invoice->paid = $invoice->paid + $request->bank_amount;
        }
        else{
            $invoice->bank = 0;
            $invoice->bank_amount = $request->bank_amount;
            $invoice->paid = $invoice->paid + $request->bank_amount;
        }
        $invoice->save();
        $invoice->pending_amount = $invoice->discounted_total + $invoice->VAT_amount - $invoice->paid;
        $invoice->save();
        return redirect()->route('invoice')->with('invoices',invoice::all())
                                            ->with('tax',settings::all());

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

