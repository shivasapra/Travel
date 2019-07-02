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
use App\invoiceInfo;
use App\ClientDoc;
use App\Invite;
use App\ClientSettings;
use App\ClientRequests;
use App\products;
use App\User;
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
            $clients = client::orderBy('id','desc')->get();
        }
        else{
            $clients = client::where('creator_id',Auth::user()->id)->orderBy('id','desc')->get();
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
        // dd($request->DOB);
        
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
            // dd(date_format($request->date));

            $test_client = client::where('unique_id','CLDC0001')->get();
            if ($test_client->count()>0) {
                $latest = client::orderBy('id','desc')->take(1)->get();
                $client_prev_no = $latest[0]->unique_id;
                $unique_id = 'CLDC000'.(substr($client_prev_no,4,7)+1);
            }
            else{
                $unique_id = 'CLDC0001';
            }
            // $unique_id = 'CLDC'. mt_rand(100000, 999999);
            // while (client::where('unique_id',$unique_id)->get()->count()>0) {
                //    $unique_id = 'CLDC'. mt_rand(100000, 999999);
                // }
        $client = new client;
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
                $client_family->member_DOB = Carbon::parse($request->member_DOB[$index])->format('d-m-Y');
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
                
                Mail::send('emails.clientConfirmation',['token'=>$token,'name'=>$client->first_name.' '.$client->last_name,'client'=>$client], function($message) use ($contactEmail)
                {
                    $message->to($contactEmail)->subject( 'Permission For Keeping Your Details' );
                });
        }

        do {
            //generate a random string using Laravel's str_random helper
            $token = str_random();
        } //check if the token already exists and if it does, try again
        while (Invite::where('token', $token)->first());

        //create a new invite record
        $invite = new Invite;
        $invite->email = $client->email;
        $invite->token = $token;
        $invite->save();
        $client->invite_id = $invite->id;
        $client->save();
        // send the email
        $contactEmail = $client->email;
        $data = array('token'=>$token,'name'=>$client->first_name.' '.$client->last_name);
        Mail::send('emails.inviteClient', $data, function($message) use ($contactEmail)
        {
            $message->to($contactEmail)->subject('Activate Your Account!!');
        });
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
        // dd(explode('.',$client->letter));
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
        // dd($client->DOB);
        $dt = Carbon::now();
        $dt->timezone('Asia/Kolkata');
        $date_today = $dt->timezone('Europe/London');
        $date = $date_today->toDateString();
        return view('clients.edit')->with('client',$client)->with('date',$date);
    }

    public function editFamily($id)
    {
        $family = ClientFamily::find($id);
        $dt = Carbon::now();
        $dt->timezone('Asia/Kolkata');
        $date_today = $dt->timezone('Europe/London');
        $date = $date_today->toDateString();
        return view('clients.editFamily')->with('family',$family)->with('date',$date);
    }

    public function deleteFamily($id)
    {
        $family = ClientFamily::find($id);
        $family->delete();
        return redirect()->back();
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
        $user = User::find($client->user_id);
        if($user != null){
            $user->email = $request->email;
            $user->save();
            }
        $client->phone = $request->phone;
        $client->credit_limit = $request->credit_limit;
        $client->client_type = $request->client_type;
        if ($request->has('passport')) {
            $client->passport = $request->passport;
            if ($request->passport == 1 ) {
                $client->passport_no = $request->passport_no;
                $client->passport_expiry_date = $request->passport_expiry_date;
                $client->passport_issue_date = $request->passport_issue_date;
                $client->passport_place = $request->passport_place;
                if($request->hasFile('passport_front'))
                    {
                    $passport_front = $request->passport_front;
                    $passport_front_new_name = time().$passport_front->getClientOriginalName();
                    $passport_front->move('uploads/passport',$passport_front_new_name);
                    $client->passport_front = 'uploads/passport/'.$passport_front_new_name;
                }
                if($request->hasFile('passport_back'))
                    {
                    $passport_back = $request->passport_back;
                    $passport_back_new_name = time().$passport_back->getClientOriginalName();
                    $passport_back->move('uploads/passport',$passport_back_new_name);
                    $client->passport_back = 'uploads/passport/'.$passport_back_new_name;
                }
                if($request->hasFile('letter'))
                    {
                    $letter = $request->letter;
                    $letter_new_name = time().$letter->getClientOriginalName();
                    $letter->move('uploads/passport',$letter_new_name);
                    $client->letter = 'uploads/passport/'.$letter_new_name;
                }

                do {
                    //generate a random string using Laravel's str_random helper
                    $token = str_random();
                } //check if the token already exists and if it does, try again
                while (client::where('token', $token)->first());
                $client->token = $token;
                $client->save();
                // send the email
                $contactEmail = $client->email;
                
                Mail::send('emails.clientConfirmation', ['token'=>$token,'name'=>$client->first_name.' '.$client->last_name,'client'=>$client], function($message) use ($contactEmail)
                {
                    $message->to($contactEmail)->subject( 'Permission For Keeping Your Details' );
                });
            }
        }
        else{
            if ($request->passport_no != null) {
                $client->passport_no = $request->passport_no;
                $client->passport_expiry_date = $request->passport_expiry_date;
                $client->passport_issue_date = $request->passport_issue_date;
                $client->passport_place = $request->passport_place;
                if($request->hasFile('passport_front'))
                    {
                    $passport_front = $request->passport_front;
                    $passport_front_new_name = time().$passport_front->getClientOriginalName();
                    $passport_front->move('uploads/passport',$passport_front_new_name);
                    $client->passport_front = 'uploads/passport/'.$passport_front_new_name;
                }
                if($request->hasFile('passport_back'))
                    {
                    $passport_back = $request->passport_back;
                    $passport_back_new_name = time().$passport_back->getClientOriginalName();
                    $passport_back->move('uploads/passport',$passport_back_new_name);
                    $client->passport_back = 'uploads/passport/'.$passport_back_new_name;
                }
                if($request->hasFile('letter'))
                    {
                    $letter = $request->letter;
                    $letter_new_name = time().$letter->getClientOriginalName();
                    $letter->move('uploads/passport',$letter_new_name);
                    $client->letter = 'uploads/passport/'.$letter_new_name;
                }
            }
        }

        if ($request->has('permanent')) {
            $client->permanent = $request->permanent;
            if ($request->permanent == 1 ){
                $client->currency = $request->currency;
                $client->credit_limit = $request->credit_limit;
            }
        }
        else{
            if($request->credit_limit != null){
                $client->credit_limit = $request->credit_limit;
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
        Session::flash('success','Client Updated Successfully');
        return redirect()->route('clients');
    }

    public function updateFamily(Request $request, $id)
    {
        $client_family = ClientFamily::find($id);
        $client_family->member_name = $request->member_name;
        $client_family->member_DOB = $request->member_DOB;
        $client_family->member_passport_no = $request->member_passport_no;
        $client_family->member_passport_place = $request->member_passport_place;
        if($request->hasFile('member_passport_front'))
        {
        $member_passport_front = $request->member_passport_front;
        $member_passport_front_new_name = time().$member_passport_front->getClientOriginalName();
        $member_passport_front->move('uploads/passport',$member_passport_front_new_name);
        $client_family->member_passport_front = 'uploads/passport/'.$member_passport_front_new_name;
        }
        if($request->hasFile('member_passport_back'))
        {
        $member_passport_back = $request->member_passport_back;
        $member_passport_back_new_name = time().$member_passport_back->getClientOriginalName();
        $member_passport_back->move('uploads/passport',$member_passport_back_new_name);
        $client_family->member_passport_back = 'uploads/passport/'.$member_passport_back_new_name;
        }
        $client_family->save();
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
        foreach ($client->family as $family) {
            $family->delete();
        }
        Session::flash('success','Client Deleted Successfully');
        return redirect()->route('clients');
    }

    public function status(){
        $clients =client::where('passport',2)->get();
        return view('status')->with('clients',$clients);
    }
    public function statusSave(Request $request){
        $client = client::where('unique_id',$request->client_id)->get();
        if ($client->count()>0) {
            $client[0]->status = $request->status;
            $client[0]->save();
            $contactEmail = $client[0]->email;
            $data = array('status'=>$request->status);
            Mail::send('emails.status', $data, function($message) use ($contactEmail)
            {
                $message->to($contactEmail);
            });
        Session::flash('success','Status Sent');
        }
        else{
            Session::flash('warning','Please Enter Valid Client Id');
        }
        $clients =client::where('passport',2)->get();
        return view('status')->with('clients',$clients);
    }

    public function search(Request $request){
        $clients = client::where('first_name', 'like', '%'.request('client_name').'%')->get();
        return view('status')->with('clients',$clients);
    }

    public function searchForDoc(Request $request){
        $invoices = invoiceInfo::where('service_name','Visa Services')->where('receiver_name', 'like', '%'.request('client_name').'%')->get();
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
        return view('clientDoc.index')->with('invoices',$invoices)->with('docs',$docs)->with('clients',$clients);
    }

    public function resendAccountConfirmation($id){
        $client = client::find($id);
        $old_invite = Invite::find($client->invite_id);
        // dd($old_invite);
        $old_invite->delete();
        do {
            //generate a random string using Laravel's str_random helper
            $token = str_random();
        } //check if the token already exists and if it does, try again
        while (Invite::where('token', $token)->first());

        //create a new invite record
        $invite = new Invite;
        $invite->email = $client->email;
        $invite->token = $token;
        $invite->save();
        $client->invite_id = $invite->id;
        $client->save();

        // send the email
        $contactEmail = $client->email;
        $data = array('token'=>$token,'name'=>$client->first_name.' '.$client->last_name);
        Mail::send('emails.inviteClient', $data, function($message) use ($contactEmail)
        {
            $message->to($contactEmail)->subject('Activate Your Account!!');
        });
        Session::flash('success','Confirmation Resent!!');
        return redirect()->back();
    }

    public function resendPassportConfirmation($id){
        $client = client::find($id);
        do {
            //generate a random string using Laravel's str_random helper
            $token = str_random();
        } //check if the token already exists and if it does, try again
        while (client::where('token', $token)->first());
        $client->token = $token;
        $client->save();
        // send the email
        $contactEmail = $client->email;
        $data = array('token'=>$token, 'name'=>$client->first_name.' '.$client->last_name);
        Mail::send('emails.clientConfirmation', $data, function($message) use ($contactEmail)
        {
            $message->to($contactEmail)->subject( 'Permission For Keeping Your Details' );
        });

        Session::flash('success','Confirmation Resent!!');
        return redirect()->back();
    }

    public function clientSettings(){
        return view('clients.settings')->with('settings',ClientSettings::first());
    }
    public function clientSettingsUpdate(Request $request){
        $settings = ClientSettings::first();
        $settings->corporate_percentage = $request->corporate_percentage;
        $settings->individual_percentage = $request->individual_percentage;
        $settings->save();
        return redirect()->back();
    }

    public function requests(){
        return view('clients.requests')->with('products',products::all());
    }

    public function requestsGenerate(Request $request){
        $client_request = new ClientRequests;
        $client_request->description = $request->description;
        $client_request->client_id = Auth::user()->client->id;
        $client_request->request_type = $request->request_type;
        $client_request->save();
        Session::flash('success','Request Generated!!');
        return redirect()->back();
    }

    public function requestStatusSave(Request $request,$id){
        $client_request = ClientRequests::find($id);
        $client_request->status = $request->status;
        $client_request->save();
        return redirect()->back();
    }

    public function activate($id){
        $user = client::find($id)->user;
        $user->active = 1;
        $user->save();
        Session::flash('success','Client Activated');
        return redirect()->back();
    }

    public function deactivate($id){
        $user = client::find($id)->user;
        $user->active = 0;
        $user->save();
        Session::flash('success','Client Deactivated');
        return redirect()->back();
    }

    public function resendCredentials($id){
        $user = client::find($id)->user;
        $data =array('email'=>$user->email,'name'=>$user->name);
        $contactEmail = $user->email;
        // Hash::check($request->password,Auth::user()->password);
        Mail::send('emails.credentials', $data, function($message) use ($contactEmail)
        {
            $message->to($contactEmail)->subject('You Have Been Registered!!');
        });
        Session::flash('success','Credentials Resent!!');
        return redirect()->back();
    }
}
