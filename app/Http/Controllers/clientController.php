<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\client;
use Session;
use Mail;
use Carbon\Carbon;
use Auth;
use App\ClientFamily;
class clientController extends Controller
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
        if (Auth::user()->admin) {
            $clients = client::all();
        }
        else{
            $clients = client::where('user_id',Auth::user()->id)->get();
        }
        return view('clients.index')->with('clients',$clients);
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
         return view('clients.create')->with('date',$date);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $client = new client;
        $unique_id = 'CLD'. mt_rand(100000, 999999);
        while (client::where('unique_id',$unique_id)->get()->count()>0) {
           $unique_id = 'CLD'. mt_rand(100000, 999999); 
        }
        $client->unique_id = $unique_id;
        $client->user_id = Auth::user()->id;
        $client->first_name = $request->first_name;
        $client->last_name = $request->last_name;
        $client->address = $request->address;
        $client->postal_code = $request->postal_code;
        $client->city = $request->city;
        $client->county = $request->county;
        $client->country = $request->country;
        $client->DOB = $request->DOB;
        $client->email = $request->email;
        $client->phone = $request->phone;
        $client->permanent = $request->permanent;
        if ($request->permanent == 1 ){
            $client->currency = $request->currency;
            $client->credit_limit = $request->credit_limit;
        }
        $client->passport = $request->passport;
        if ($request->passport == 1 ) {
            $client->passport_no = $request->passport_no;
            $client->passport_expiry_date = $request->passport_expiry_date;
            $client->passport_issue_date = $request->passport_issue_date;
            $client->passport_place = $request->passport_place;
            if($request->hasFile('passport_front'))
                {
                    // dd('true');
                $passport_front = $request->passport_front;
                $passport_front_new_name = time().$passport_front->getClientOriginalName();
                $passport_front->move('uploads/passport',$passport_front_new_name);
                $client->passport_front = 'uploads/passport/'.$passport_front_new_name;
                // $client->save();
                }
            if($request->hasFile('passport_back'))
                {
                    // dd('true');
                $passport_back = $request->passport_back;
                $passport_back_new_name = time().$passport_back->getClientOriginalName();
                $passport_back->move('uploads/passport',$passport_back_new_name);
                $client->passport_back = 'uploads/passport/'.$passport_back_new_name;
                // $client->save();
                }
            if($request->hasFile('letter'))
                {
                    // dd('true');
                $letter = $request->letter;
                $letter_new_name = time().$letter->getClientOriginalName();
                $letter->move('uploads/passport',$letter_new_name);
                $client->letter = 'uploads/passport/'.$letter_new_name;
                // $client->save();
                }

        }
        $client->save();
        if($request->member_name){
            foreach($request->member_name as $index=>$member_name){
                $client_family = new ClientFamily;
                $client_family->client_id = $client->id;
                $client_family->member_name = $member_name;
                $client_family->member_DOB = $request->member_DOB[$index];
                $client_family->member_passport_no = $request->member_passport_no[$index];
                $client_family->member_passport_place = $request->member_passport_place[$index];
                if($request->hasFile('member_passport_front'))
                {
                $member_passport_front = $request->member_passport_front[$index];
                $member_passport_front_new_name = time().$member_passport_front->getClientOriginalName();
                $member_passport_front->move('uploads/passport',$member_passport_front_new_name);
                $client_family->member_passport_front = 'uploads/passport/'.$member_passport_front_new_name;
                }
            if($request->hasFile('member_passport_back'))
                {
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
                    //generate a random string using Laravel's str_random helper
                    $token = str_random();
                } //check if the token already exists and if it does, try again
                while (client::where('token', $token)->first());
                $client->token = $token;
                $client->save();
                // send the email
                $contactEmail = $client->email;
                $data = array('token'=>$token);
                Mail::send('emails.clientConfirmation', $data, function($message) use ($contactEmail)
                { 
                    $message->to($contactEmail)->subject( 'Permission For Keeping Your Details' );
                });
        }
        
        Session::flash('success','Client Created Successfully');
        return redirect()->route('clients');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $client = client::find($id);
        // dd($client);
        return view('clients.show')->with('client',$client);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $client = client::find($id);
        return view('clients.edit')->with('client',$client);
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
        $client = client::find($id);
        $client->first_name = $request->first_name;
        $client->last_name = $request->last_name;
        $client->address = $request->address;
        $client->postal_code = $request->postal_code;
        $client->city = $request->city;
        $client->county = $request->county;
        $client->country = $request->country;
        $client->DOB = $request->DOB;
        $client->email = $request->email;
        $client->phone = $request->phone;
        if ($request->passport_no != null ) {
            $client->passport_no = $request->passport_no;
            $client->passport_expiry_date = $request->passport_expiry_date;
            $client->passport_issue_date = $request->passport_issue_date;
            $client->passport_place = $request->passport_place;

        }
        $client->save();
        Session::flash('success','Client Updated Successfully');
        return redirect()->route('clients');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $client = client::find($id);
        $client->delete();
        Session::flash('success','Client Deleted Successfully');
        return redirect()->route('clients');
    }

    public function status(){
        $clients =client::where('passport',2)->get();
        return view('status')->with('clients',$clients);
    }
    public function statusSave(Request $request){
        $client = client::where('unique_id',$request->client_id)->get();
        $client[0]->status = $request->status;
        $client[0]->save();
        $contactEmail = $client[0]->email;
        $data = array('status'=>$request->status);
        Mail::send('emails.status', $data, function($message) use ($contactEmail)
        {  
            $message->to($contactEmail);
        });
        return redirect()->back();
    }

    public function search(Request $request){
        $clients = client::where('first_name', 'like', '%'.request('client_name').'%')->get();
        return view('status')->with('clients',$clients);
    }
}
