<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\client;
use Session;
use Mail;
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
        return view('clients.index')->with('clients',client::all());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
         return view('clients.create');
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
}
