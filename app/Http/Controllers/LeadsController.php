<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\client;
use Session;
use Validator;
use Mail;
use Carbon\Carbon;
use Auth;
use App\ClientFamily;
use App\Leads;
use App\Invite;      

class LeadsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        $leads = Leads::all();
        return view('leads.index')->with('leads',$leads);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('leads.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {   
        $lead = new Leads;
        $lead->user_id = Auth::user()->id;
        $lead->first_name = $request->first_name;
        $lead->last_name = $request->last_name;
        $lead->address = $request->address;
        $lead->city = $request->city;
        $lead->county = $request->county;
        $lead->postal_code = $request->postal_code;
        $lead->country = $request->country;
        $lead->phone = $request->phone;
        $lead->email = $request->email;
        $lead->DOB = $request->DOB;
        $lead->save();
        $leads = Leads::all();
        return view('leads.index')->with('leads',$leads);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $lead = Leads::find($id);
        return view('leads.show')->with('lead',$lead);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $lead = Leads::find($id);
        return view('leads.edit')->with('lead',$lead);
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
        $lead = Leads::find($id);
        $lead->first_name = $request->first_name;
        $lead->last_name = $request->last_name;
        $lead->address = $request->address;
        $lead->city = $request->city;
        $lead->county = $request->county;
        $lead->postal_code = $request->postal_code;
        $lead->country = $request->country;
        $lead->phone = $request->phone;
        $lead->email = $request->email;
        $lead->DOB = $request->DOB;
        $lead->save();
        $leads = Leads::all();
        return view('leads.index')->with('leads',$leads);
    }

    public function convertForm($id){
        $lead = Leads::find($id);
        return view('leads.convertForm')->with('lead',$lead)
                                        ->with('id',$id)
                                        ->with('date',Carbon::now()->toDateString());
    }

    public function convert(Request $request){
        Validator::make($request->all(), [
            'first_name' => 'required',
            'last_name' => 'required',
            'address' => 'required',
            'postal_code' => 'required',
            'city' => 'required',
            'county' => 'required',
            'country' => 'required',
            'DOB' => array('required','regex:/[0-9]{4,4}\-[0-9]{2}\-[0-9]{2}/'),
            'email' => 'unique:users|unique:clients',
            'phone' => 'required',
            ])->validate();

        $client = new client;
        $unique_id = 'CLDC'. mt_rand(100000, 999999);
        while (client::where('unique_id',$unique_id)->get()->count()>0) {
           $unique_id = 'CLDC'. mt_rand(100000, 999999);
        }
        $client->unique_id = $unique_id;
        $client->creator_id = Auth::user()->id;
        $client->first_name = $request->first_name;
        $client->last_name = $request->last_name;
        $client->address = $request->address;
        $client->postal_code = $request->postal_code;
        $client->city = $request->city;
        $client->county = $request->county;
        $client->country = $request->country;
        $client->DOB = Carbon::parse($request->DOB)->format('d-m-Y');
        $client->email = $request->email;
        $client->phone = $request->phone;
        $client->permanent = $request->permanent;
        $client->client_type = $request->client_type;
        if ($request->permanent == 1 ){
            $client->currency = $request->currency;
            $client->credit_limit = $request->credit_limit;
        }
        $client->passport = $request->passport;
        if ($request->passport == 1 ){
            $client->passport_no = $request->passport_no;
            $client->passport_expiry_date = $request->passport_expiry_date;
            $client->passport_issue_date = $request->passport_issue_date;
            $client->passport_place = $request->passport_place;
            if($request->hasFile('passport_front')){
                $passport_front = $request->passport_front;
                $passport_front_new_name = time().$passport_front->getClientOriginalName();
                $passport_front->move('uploads/passport',$passport_front_new_name);
                $client->passport_front = 'uploads/passport/'.$passport_front_new_name;
            }
            if($request->hasFile('passport_back')){
                $passport_back = $request->passport_back;
                $passport_back_new_name = time().$passport_back->getClientOriginalName();
                $passport_back->move('uploads/passport',$passport_back_new_name);
                $client->passport_back = 'uploads/passport/'.$passport_back_new_name;
            }
            if($request->hasFile('letter')){
                $letter = $request->letter;
                $letter_new_name = time().$letter->getClientOriginalName();
                $letter->move('uploads/passport',$letter_new_name);
                $client->letter = 'uploads/passport/'.$letter_new_name;
            }
        }
        $client->save();
        if($request->member_name){
            foreach($request->member_name as $index=>$member_name){
                $client_family = new ClientFamily;
                $client_family->client_id = $client->id;
                $client_family->member_name = $member_name;
                $client_family->member_DOB = Carbon::parse($request->member_DOB[$index])->format('d-m-Y');
                $client_family->member_passport_no = $request->member_passport_no[$index];
                $client_family->member_passport_place = $request->member_passport_place[$index];
                if($request->hasFile('member_passport_front')){
                    $member_passport_front = $request->member_passport_front[$index];
                    $member_passport_front_new_name = time().$member_passport_front->getClientOriginalName();
                    $member_passport_front->move('uploads/passport',$member_passport_front_new_name);
                    $client_family->member_passport_front = 'uploads/passport/'.$member_passport_front_new_name;
                }
                if($request->hasFile('member_passport_back')){
                    $member_passport_back = $request->member_passport_back[$index];
                    $member_passport_back_new_name = time().$member_passport_back->getClientOriginalName();
                    $member_passport_back->move('uploads/passport',$member_passport_back_new_name);
                    $client_family->member_passport_back = 'uploads/passport/'.$member_passport_back_new_name;
                }
                $client_family->save();
            }
        }
        if ($request->passport == 1 and $client->confirmation == 0) {
            do {
                $token = str_random();
            }while (client::where('token', $token)->first());
            $client->token = $token;
            $client->save();
            $contactEmail = $client->email;
            $data = array('token'=>$token,'name'=>$client->first_name.' '.$client->last_name);
            Mail::send('emails.clientConfirmation', $data, function($message) use ($contactEmail)
            {
                $message->to($contactEmail)->subject( 'Permission For Keeping Your Details' );
            });
        }
        do {
            $token = str_random();
        }
        while (Invite::where('token', $token)->first());
        $invite = new Invite;
        $invite->email = $client->email;
        $invite->token = $token;
        $invite->save();
        $client->invite_id = $invite->id;
        $client->save();
        $contactEmail = $client->email;
        $data = array('token'=>$token,'name'=>$client->first_name.' '.$client->last_name);
        Mail::send('emails.inviteClient', $data, function($message) use ($contactEmail)
        {
            $message->to($contactEmail)->subject('Activate Your Account!!');
        });
        $lead = Leads::find($request->lead_id);
        $lead->client_id = $client->id;
        $lead->converted = 1;
        $lead->save();

        Session::flash('success','Client Created Successfully');
        return redirect()->route('leads');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
